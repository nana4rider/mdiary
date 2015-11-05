<?php
/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/28
 * Time: 22:49
 */

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\Work;
use App\Models\WorkField;
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
        // 作物一覧を取得
        $cropOptions = Crop::orderBy('display_order')->get()->lists('name', 'id');

        // 未選択の場合、先頭の作物を選択
        $cropId = $request->session()->getOldInput('cropId') ?: (string)$cropOptions->keys()->first();
        // 選択中の作物を取得
        $crop = Crop::find($cropId);

        // 編集中の日誌がある圃場一覧を取得
        $workFieldOptions = WorkField::hasActiveDiary($cropId)->orderBy('display_order')->get()->lists('name', 'id');

        // 作物に紐付く作業内容を取得
        $workOptions = $crop->works()->orderBy('works.display_order')->get()->lists('name', 'id');

        // 未選択の場合、先頭の作業を選択
        $workId = $request->session()->getOldInput('workId') ?: (string)$workOptions->keys()->first();
        // 選択中の作業内容を取得
        $work = Work::find($workId);

        // 作物に紐付く農薬情報を取得
        $pesticides = $crop->pesticides()->with('unit')->get();
        $pesticidesJson = $this->createPesticidesJson($pesticides);
        $pesticideOptions = $pesticides->lists('name', 'id');

        return view('workRecord.create', compact(
            'cropOptions', 'workFieldOptions', 'workOptions', 'work',
            'pesticides', 'pesticideOptions', 'pesticidesJson'
        ));
    }

    private function createPesticidesJson($pesticides)
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
     * フォームの表示内容を変更
     *
     * @param Request $request
     * @return $this
     */
    public function changeForm(Request $request)
    {
        return redirect()->back()->withInput($request->all());
    }

    public function store()
    {
        return new JsonResponse(['usage' => 'world'], 422);
    }
}