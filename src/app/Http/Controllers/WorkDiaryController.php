<?php
/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/28
 * Time: 22:49
 */

namespace App\Http\Controllers;


use App\Http\Requests\WorkDiaryStoreRequest;
use App\Models\Crop;
use App\Models\WorkField;
use Illuminate\Support\Facades\Request;

class WorkDiaryController extends Controller
{
    /**
     * 一覧表示
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('workDiary.index');
    }

    /**
     * 作成画面
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // 作物一覧を取得
        $cropOptions = Crop::all()->lists('name', 'id');
        // 圃場一覧を取得
        $workFieldOptions = WorkField::orderBy('display_order')->get()->lists('name', 'id');

        return view('workDiary.create', compact('cropOptions', 'workFieldOptions'));
    }

    /**
     * 作成処理
     * @param WorkDiaryStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(WorkDiaryStoreRequest $request)
    {
        // トランザクション開始→セレクトしてアーカイブを確認
    }
}