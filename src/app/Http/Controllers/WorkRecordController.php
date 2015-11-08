<?php
/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/28
 * Time: 22:49
 */

namespace App\Http\Controllers;

use App\Http\Requests\WorkRecordAddPesticideRequest;
use App\Models\Crop;
use App\Models\Pesticide;
use App\Models\Work;
use App\Models\WorkField;
use App\Models\WorkPestControl;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorkRecordController extends Controller
{
    public function index()
    {
        return view('workRecord.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        if (empty(old('cropId'))) {
            session()->forget('workRecord.workPestControls');
        }

        // 作物一覧を取得
        $cropOptions = Crop::orderBy('display_order')->get()->lists('name', 'id');
        // 未選択の場合、先頭の作物を選択
        $cropId = old('cropId') ?: (string)$cropOptions->keys()->first();

        // 選択中の作物を取得
        $crop = Crop::findOrFail($cropId);

        // 編集中の日誌がある圃場一覧を取得
        $workFieldOptions = WorkField::hasActiveDiary($cropId)->orderBy('display_order')->get()->lists('name', 'id');

        // 作物に紐付く作業内容を取得
        $workOptions = $crop->works()->orderBy('works.display_order')->get()->lists('name', 'id');

        // 未選択の場合、先頭の作業を選択
        $workId = old('workId') ?: (string)$workOptions->keys()->first();
        // 選択中の作業内容を取得
        $work = Work::findOrFail($workId);

        $viewData = compact('cropOptions', 'workFieldOptions', 'workOptions', 'work');

        // 作物に紐付く農薬情報を取得
        if ($work->use_pest_control) {
            $pesticides = $crop->pesticides()->with('unit')->get();
            $pesticidesJson = $this->createPesticidesJson($pesticides);
            $pesticideOptions = $pesticides->lists('name', 'id');

            $viewData = array_merge($viewData, compact(
                'pesticides', 'pesticideOptions', 'pesticidesJson'
            ));
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
    public
    function changeForm(Request $request)
    {
        // 農薬情報をクリア
        session()->forget('workRecord.workPestControls');

        return redirect()->back()->withInput($request->all());
    }

    private
    function createPesticidesJson($pesticides)
    {
        $array = [];
        foreach ($pesticides as $pesticide) {
            $name = $pesticide->name;
            $minimumUsage = $pesticide->minimum_usage;
            $maximumUsage = $pesticide->maximum_usage;
            $unitName = $pesticide->unit->name;

            $array[] = compact('name', 'minimumUsage', 'maximumUsage', 'unitName');
        }
        return json_encode($array);
    }

    /**
     * 農薬を追加
     *
     * @param WorkRecordAddPesticideRequest $request
     * @return \Illuminate\View\View
     */
    public
    function addPesticide(WorkRecordAddPesticideRequest $request)
    {
        $sessionWorkPestControls = session()->get('workRecord.workPestControls', []);

        $pesticideId = $request->input('pesticideId');
        unset($sessionWorkPestControls[$pesticideId]);

        $workPestControl = new WorkPestControl();
        $workPestControl->pesticideId = $pesticideId;
        $workPestControl->pesticide = Pesticide::findOrFail($pesticideId);
        $workPestControl->usage = $request->input('pesticideUsage');

        $sessionWorkPestControls[$pesticideId] = $workPestControl;
        session()->put('workRecord.workPestControls', $sessionWorkPestControls);

        return view('workRecord.pesticide');
    }

    /**
     * 農薬を削除
     *
     * @param $pesticideId
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public
    function deletePesticide($pesticideId, Request $request)
    {
        $sessionWorkPestControls = session()->get('workRecord.workPestControls', []);

        unset($sessionWorkPestControls[$pesticideId]);

        session()->put('workRecord.workPestControls', $sessionWorkPestControls);

        return view('workRecord.pesticide');
    }

    public
    function store()
    {
        return new JsonResponse(['pesticideId' => 'world'], 422);
    }
}