<?php
/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/28
 * Time: 22:49
 */

namespace App\Http\Controllers;

use App\Models\TextDiary;
use App\Models\TextDiaryCategory;
use App\Services\FlickrService;
use DB;
use Illuminate\Http\Request;
use Input;
use Validator;

class TextDiaryController extends Controller
{
    private function getCatetoryOptions()
    {
        return options(TextDiaryCategory::orderBy('display_order')->get());
    }

    /**
     * 一覧表示
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // カテゴリ毎の日記件数
        $dairyCount = DB::table('text_diary_text_diary_category')
            ->select('text_diary_category_id', DB::raw('count(*) as count'))
            ->groupBy('text_diary_category_id')
            ->lists('count', 'text_diary_category_id');

        // 日記が存在するカテゴリ
        $categories = TextDiaryCategory::whereIn('id', array_keys($dairyCount))->orderBy('display_order')->get();

        $textDiaries = TextDiary::with('textDiaryCategories')->with('flickrs')
            ->whereHas('textDiaryCategories', function ($q) use ($request) {
                if ($request->has('category')) {
                    // 選択したカテゴリで絞込
                    $q->where('id', '=', $request->get('category'));
                }
            })->orderBy('datetime', 'desc')->paginate(config('const.max_text_diary'));

        return view('textDiary.index', compact('categories', 'dairyCount', 'textDiaries'));
    }

    /**
     * 作成画面
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categoryOptions = $this->getCatetoryOptions();

        return view('textDiary.create', compact('categoryOptions'));
    }

    /**
     * 作成処理
     * @param Request $request
     * @param FlickrService $flickrService
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, FlickrService $flickrService)
    {
        // 入力検証
        $v = Validator::make($request->all(), [
            'datetime' => 'required|date_format:"' . config('format.datetime') . '"',
            'title' => 'required|max:100',
            'body' => 'required|max:10000',
            'category' => 'required',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput($request->all());
        }

        // 入力検証(写真)
        foreach (Input::file('picture') as $picture) {
            $v = Validator::make(array('picture' => $picture), array('picture' => 'mimes:jpeg,bmp,png'));

            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors())->withInput($request->all());
            }
        }

        // 選択したカテゴリの名称を取得
        $categories = TextDiaryCategory::whereIn('id', $request->category)->orderBy('display_order')->get();
        $categoryNames = options($categories, null);

        // 写真をFlickrにアップロード
        $flickrIds = [];
        foreach (Input::file('picture') as $picture) {
            if (is_null($picture)) {
                continue;
            }

            DB::transaction(function () use ($request, &$flickrIds, $flickrService, $picture, $categoryNames) {
                $flickr = $flickrService->upload($picture->getRealPath(), $request->title, null, $categoryNames);
                $flickrIds[] = $flickr->getKey();
            });
        }

        $textDiary = new TextDiary();
        DB::transaction(function () use ($request, &$flickrIds, $textDiary) {
            // 日記登録
            $textDiary->fill($request->all());
            $textDiary->save();

            // カテゴリ紐付け
            $textDiary->textDiaryCategories()->attach($request->category);

            // Flickr保存・紐付け
            $textDiary->flickrs()->attach($flickrIds);
        });

        return redirect()->back()->with('newEntity', $textDiary);
    }

    public function edit($id)
    {
        $categoryOptions = $this->getCatetoryOptions();
        $textDiary = TextDiary::find($id);

        return view('textDiary.edit', compact('categoryOptions', 'textDiary'));
    }

    public function destroy($id)
    {
        TextDiary::destroy($id);

        return redirect('textDiary');
    }
}