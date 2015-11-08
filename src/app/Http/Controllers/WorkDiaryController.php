<?php
/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/28
 * Time: 22:49
 */

namespace App\Http\Controllers;

use App\Http\Requests\WorkDiaryStoreRequest;
use App\Http\Requests\WorkDiaryUpdateRequest;
use App\Models\Crop;
use App\Models\WorkDiary;
use App\Models\WorkField;
use DB;
use Illuminate\Http\Request;

class WorkDiaryController extends Controller
{
    /**
     * 一覧表示
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data = $request->all();

        // 日誌一覧を取得
        $builder = WorkDiary::with('crop', 'workField');

        if (!is_null($request->input('field_ids'))) {
            $builder->whereIn('work_field_id', (array)$request->input('field_ids'));
        }

        if (is_null($request->input('archive'))) {
            $builder->where('archive', false);
        }

        $workDiaries = $builder->orderBy('archive')->latest()->paginate(config('const.max_work_diary'));

        // 圃場一覧を取得
        $workFieldOptions = WorkField::orderBy('display_order')->get()->lists('name', 'id');

        return view('workDiary.index', compact('workFieldOptions', 'data', 'workDiaries'));
    }

    /**
     * 詳細画面
     *
     * @param WorkDiary $workDiary
     * @return \Illuminate\View\View
     */
    public function show(WorkDiary $workDiary)
    {
        return view('workDiary.show', compact('workDiary'));
    }

    /**
     * 編集画面
     *
     * @param WorkDiary $workDiary
     * @return \Illuminate\View\View
     */
    public function edit(WorkDiary $workDiary)
    {
        if ($workDiary->archive) {
            // アーカイブ済みは編集不可
            return redirect()->route('workDiary.index');
        }

        // 作物一覧を取得
        $cropOptions = Crop::orderBy('display_order')->get()->lists('name', 'id');

        return view('workDiary.edit', compact('workDiary', 'cropOptions'));
    }

    /**
     * 作成画面
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // 作物一覧を取得
        $cropOptions = Crop::orderBy('display_order')->get()->lists('name', 'id');
        // 編集中の日誌がない圃場一覧を取得
        $workFieldOptions = WorkField::doesntHaveActiveDiary()->orderBy('display_order')->get()->lists('name', 'id');

        return view('workDiary.create', compact('cropOptions', 'workFieldOptions'));
    }

    /**
     * 作成処理
     *
     * @param WorkDiaryStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(WorkDiaryStoreRequest $request)
    {
        $errors = [];
        DB::transaction(function () use ($request, &$errors) {
            $fieldIds = (array)$request->input('field_ids');
            $workFields = WorkField::whereIn('id', $fieldIds)->lockForUpdate()->get();

            if (!WorkField::whereIn('id', $fieldIds)->hasActiveDiary()->get()->isEmpty()) {
                // 編集中日誌のある圃場が選択されている
                $errors['field_ids'] = message('others_update');
                DB::rollBack();
                return;
            }

            /** @var WorkField $workField */
            foreach ($workFields as $workField) {
                // 日誌を作成
                $workDiary = new WorkDiary();
                $workDiary->crop_id = $request->get('crop_id');
                $workDiary->work_field_id = $workField->id;
                $workDiary->archive = false;
                $workDiary->fill($request->all());
                $workDiary->save();
            }
        });

        if (!empty($errors)) {
            return redirect()->back()->withInput($request->all())->withErrors($errors);
        }

        return redirect()->route('workDiary.index')->with('complete', 'store');
    }

    /**
     * 更新処理
     *
     * @param WorkDiary $workDiary
     * @param WorkDiaryUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(WorkDiary $workDiary, WorkDiaryUpdateRequest $request)
    {
        DB::transaction(function () use ($request, $workDiary) {
            $workDiary->archive = $request->has('archive');
            $workDiary->fill($request->all());
            $workDiary->save();
        });

        return redirect()->route('workDiary.index')->with('complete', 'update');
    }

    /**
     * 削除処理
     * @param WorkDiary $workDiary
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(WorkDiary $workDiary)
    {
        $workDiary->archive = true;
        $workDiary->delete();

        return redirect()->route('workDiary.index')->with('complete', 'destroy');
    }
}