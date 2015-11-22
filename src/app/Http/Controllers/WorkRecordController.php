<?php
/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/28
 * Time: 22:49
 */

namespace App\Http\Controllers;

use App\Http\Requests\WorkRecordAddPesticideRequest;
use App\Http\Requests\WorkRecordStoreRequest;
use App\Models\Crop;
use App\Models\Pesticide;
use App\Models\Work;
use App\Models\WorkDiary;
use App\Models\WorkField;
use App\Models\WorkPestControl;
use App\Models\WorkRecord;
use App\Models\WorkSeeding;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class WorkRecordController extends Controller
{
    /**
     * 一覧表示
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // 作物一覧を取得
        $crops = Crop::orderBy('display_order')->get();
        // 未選択の場合、先頭の作物を選択
        $crop = Crop::findOrFail($request->input('crop_id') ?: $crops->first()->id);

        // 作物に紐付く作業内容を取得
        $works = $crop->works()->orderBy('works.display_order')->get();

        // 圃場一覧を取得
        $workFields = WorkField::orderBy('display_order')->get();

        if ($request->ajax()) {
            return compact('crops', 'works', 'workFields');
        } else {
            return view('workRecord.index', compact('crops', 'works', 'workFields'));
        }
    }

    /**
     * 作成画面
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        // 農薬情報をクリア
        session()->forget('workRecord.pesticides');

        // 作物一覧を取得
        $crops = Crop::orderBy('display_order')->get();
        // 未選択の場合、先頭の作物を選択
        $crop = Crop::findOrFail($request->input('crop_id') ?: $crops->first()->id);

        // 編集中の日誌がある作業日誌を取得
        $workDiaries = WorkDiary::with('workField')->where('archive', false)->where('crop_id', $crop->id)
            ->get()->sortBy('workField.display_order');

        // 作物に紐付く作業内容を取得
        $works = $crop->works()->orderBy('works.display_order')->get();

        // 品種を取得
        $cultivars = $crop->cultivars()->get();

        // 農薬情報を取得
        $pesticides = $crop->pesticides()->with('unit')->get();

        if ($request->ajax()) {
            return compact('workDiaries', 'works', 'cultivars', 'pesticides');
        } else {
            return view('workRecord.create', compact('crops', 'workDiaries', 'works', 'cultivars', 'pesticides'));
        }
    }

    /**
     * 農薬追加
     *
     * @param WorkRecordAddPesticideRequest $request
     * @return \Illuminate\View\View
     */
    public function addPesticide(WorkRecordAddPesticideRequest $request)
    {
        $sessionPesticides = session()->get('workRecord.pesticides', collect());

        $pesticideId = $request->input('pesticide_id');
        $pesticide = Pesticide::findOrFail($pesticideId);

        $sessionPesticides->put($pesticideId, collect([
            'pesticide_id' => $pesticideId,
            'usage' => $request->input('pesticide_usage'),
            'pesticide_name' => $pesticide->name,
            'unit_name' => $pesticide->unit->name
        ]));

        session()->put('workRecord.pesticides', $sessionPesticides);

        return view('workRecord.pesticide');
    }

    /**
     * 農薬削除
     *
     * @param $pesticideId
     * @return \Illuminate\View\View
     */
    public function deletePesticide($pesticideId)
    {
        $sessionPesticides = session()->get('workRecord.pesticides', collect());

        $sessionPesticides->forget($pesticideId);

        session()->put('workRecord.pesticides', $sessionPesticides);

        return view('workRecord.pesticide');
    }

    /**
     * 作成処理
     *
     * @param WorkRecordStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(WorkRecordStoreRequest $request)
    {
        $errors = new MessageBag();
        DB::transaction(function () use ($request, &$errors) {
            $workId = $request->input('work_id');
            $cropId = $request->input('crop_id');
            $workDiaryIds = (array)$request->input('work_diary_ids');

            $work = Work::findOrFail($workId);
            $workDiaries = WorkDiary::whereIn('id', $workDiaryIds)->lockForUpdate()->get();

            if ($workDiaries->count() !== $workDiaries->where('crop_id', $cropId)
                    ->where('archive', false)->count()
            ) {
                // 不正な作業日誌が選択されている
                $errors->add('work_diary_ids', message('others_update'));
                DB::rollBack();
                return;
            }

            // 作業記録登録
            $workRecord = new WorkRecord();
            $workRecord->fill($request->all());
            $workRecord->work_id = $workId;
            // use_complete=falseの場合は常にtrue
            $workRecord->complete = !$work->use_complete || $request->has('complete');
            $workRecord->save();

            // 防除記録
            if ($work->use_pest_control) {
                $sessionPesticides = session()->get('workRecord.pesticides');

                $pesticideIds = $sessionPesticides->keys();
                $pesticides = Pesticide::whereIn('id', $pesticideIds)
                    ->whereHas('crops', function ($query) use ($cropId) {
                        $query->where('crop_id', $cropId);
                    });

                if ($pesticideIds->count() !== $pesticides->count()) {
                    // 農薬の選択が不正
                    $errors->add('pesticide', message('others_update'));
                    DB::rollBack();
                    return;
                }

                foreach ($sessionPesticides as $sessionPesticide) {
                    $workPestControl = new WorkPestControl();
                    $workPestControl->work_record_id = $workRecord->id;
                    $workPestControl->pesticide_id = $sessionPesticide->get('pesticide_id');
                    $workPestControl->usage = $sessionPesticide->get('usage');
                    $workPestControl->save();
                }
            }

            // 播種/定植記録
            if ($work->use_seeding) {
                $workSeeding = new WorkSeeding();
                $workSeeding->work_record_id = $workRecord->id;
                $workSeeding->cultivar_id = $request->input('cultivar_id');
                $workSeeding->fill($request->all());
                $workSeeding->save();
            }

            // 日誌紐付け
            $workRecord->workDiaries()->attach($workDiaryIds);
        });

        if ($errors->any()) {
            return $this->buildFailedValidationResponse($request, $errors->toArray());
        }

        // 農薬情報をクリア
        session()->forget('workRecord.pesticides');

        return redirect()->route('workRecord.index')->with('complete', 'store');
    }
}