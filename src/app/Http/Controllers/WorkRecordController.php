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
use App\Models\WorkPestControl;
use App\Models\WorkRecord;
use App\Models\WorkSeeding;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class WorkRecordController extends Controller
{
    public function index()
    {
        return view('workRecord.index');
    }

    /**
     * 作成画面
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (empty(old('crop_id'))) {
            session()->forget('workRecord.pesticides');
        }

        // 作物一覧を取得
        $cropOptions = Crop::orderBy('display_order')->get()->lists('name', 'id');
        // 未選択の場合、先頭の作物を選択
        $cropId = old('crop_id') ?: (string)$cropOptions->keys()->first();

        // 選択中の作物を取得
        $crop = Crop::findOrFail($cropId);

        // 編集中の日誌がある圃場一覧を取得
        $workDiaryOptions = WorkDiary::with('workField')->where('archive', false)->where('crop_id', $cropId)
            ->get()->sortBy('workField.display_order')->lists('name', 'id');

        // 作物に紐付く作業内容を取得
        $workOptions = $crop->works()->orderBy('works.display_order')->get()->lists('name', 'id');

        // 未選択の場合、先頭の作業を選択
        $workId = old('work_id') ?: (string)$workOptions->keys()->first();
        // 選択中の作業内容を取得
        $work = Work::findOrFail($workId);

        $viewData = compact('cropOptions', 'workDiaryOptions', 'workOptions', 'work');

        // 作物に紐付く農薬情報を取得
        if ($work->use_pest_control) {
            $pesticides = $crop->pesticides()->with('unit')->get();
            $viewData['pesticides'] = $pesticides;
            $viewData['pesticidesJson'] = $this->createPesticidesJson($pesticides);
            $viewData['pesticideOptions'] = $pesticides->lists('name', 'id');
        }

        // 作物に紐付く品種を取得
        if ($work->use_seeding) {
            $cultivars = $crop->cultivars()->get();
            $cultivarOptions = $cultivars->lists('name', 'id');

            $viewData = array_merge($viewData, compact('cultivarOptions'));
        }

        return view('workRecord.create', $viewData);
    }

    /**
     * フォームの表示内容を変更
     *
     * @param Request $request
     * @return $this
     */
    public function changeForm(Request $request)
    {
        // 農薬情報をクリア
        session()->forget('workRecord.pesticides');

        return redirect()->back()->withInput($request->all());
    }

    private function createPesticidesJson($pesticides)
    {
        $array = [];
        foreach ($pesticides as $pesticide) {
            $array[] = [
                'name' => $pesticide->name,
                'minimum_usage' => $pesticide->minimum_usage,
                'maximum_usage' => $pesticide->maximum_usage,
                'unit_name' => $pesticide->unit->name,
            ];
        }
        return json_encode($array);
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

        return redirect()->route('workRecord.index')->with('complete', 'store');
    }
}