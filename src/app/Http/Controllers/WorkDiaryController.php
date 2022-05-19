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
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

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
        // 日誌一覧を取得
        $builder = WorkDiary::with('crop', 'workField');

        if (!is_null($request->input('field_ids'))) {
            $builder->whereIn('work_field_id', (array)$request->input('field_ids'));
        }

        if (!$request->has('archive')) {
            $builder->where('archive', false);
        }

        $workDiaries = $builder->orderBy('archive')->latest()->paginate(config('const.max_work_diary'));

        // 圃場一覧を取得
        $workFields = WorkField::orderBy('display_order')->get();

        return view('workDiary.index', compact('workFields', 'data', 'workDiaries'));
    }

    /**
     * 詳細画面
     *
     * @param WorkDiary $workDiary
     * @return \Illuminate\View\View
     */
    public function show(WorkDiary $workDiary)
    {
        $workRecords = $workDiary->workRecords()->with([
            'work',
            'workSeeding',
            'workSeeding.cultivar',
            'workPestControls' => function ($query) {
                $query->orderBy('id');
            },
            'workPestControls.pesticide',
            'workPestControls.pesticide.unit'
        ])->orderBy('datetime')->get();

        // 農薬使用記録
        $pesticideSummary = collect(DB::table('work_diary_work_record')
            ->join('work_records', 'work_records.id', '=', 'work_diary_work_record.work_record_id')
            ->join('work_pest_controls', 'work_pest_controls.work_record_id', '=', 'work_records.id')
            ->join('pesticides', 'pesticides.id', '=', 'work_pest_controls.pesticide_id')
            ->select(DB::raw(
                'pesticides.name as pesticide_name,' .
                'count(pesticides.id) as usage_count,' .
                'pesticides.usage_count as max_usage_count,' .
                'max(work_records.datetime) as latest_datetime,' .
                'pesticides.aftereffect_dates as aftereffect_dates'
            ))
            ->where('work_diary_work_record.work_diary_id', $workDiary->id)
            ->groupBy('pesticides.id')
            ->get())
            ->each(function (&$data) {
                // to carbon
                $data->latest_datetime = Carbon::createFromFormat('Y-m-d H:i:s', $data->latest_datetime);
            });

        return view('workDiary.show', compact('workDiary', 'workRecords', 'pesticideSummary'));
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

        return view('workDiary.edit', compact('workDiary'));
    }

    /**
     * 作成画面
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // 作物一覧を取得
        $crops = Crop::orderBy('display_order')->get();
        // 編集中の日誌がない圃場一覧を取得
        $workFields = WorkField::doesntHaveActiveDiary()->orderBy('display_order')->get();

        return view('workDiary.create', compact('crops', 'workFields'));
    }

    /**
     * 作成処理
     *
     * @param WorkDiaryStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(WorkDiaryStoreRequest $request)
    {
        $errors = new MessageBag();
        DB::transaction(function () use ($request, &$errors) {
            $fieldIds = (array)$request->input('field_ids');
            $workFields = WorkField::whereIn('id', $fieldIds)->lockForUpdate()->get();

            if (!WorkField::whereIn('id', $fieldIds)->hasActiveDiary()->get()->isEmpty()) {
                // 編集中日誌のある圃場が選択されている
                $errors->add('field_ids', message('others_update'));
                DB::rollBack();
                return;
            }

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

        if ($errors->any()) {
            return $this->buildFailedValidationResponse($request, $errors->toArray());
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