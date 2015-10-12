<?php
/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/28
 * Time: 22:49
 */

namespace App\Http\Controllers;

use App\Http\Requests\TextDiaryRequest;
use App\Models\TextDiary;
use App\Models\TextDiaryCategory;
use App\Services\FlickrService;
use DB;
use Illuminate\Http\Request;

class TextDiaryController extends Controller
{
    protected $flickrService;

    public function __construct(FlickrService $flickrService)
    {
        $this->flickrService = $flickrService;
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
                    $q->where('id', '=', $request->input('category'));
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
        $categoryOptions = TextDiaryCategory::orderBy('display_order')->lists('name', 'id');

        return view('textDiary.create', compact('categoryOptions'));
    }

    /**
     * 写真をFlickrにアップロード
     *
     * @param $files
     * @param $title
     * @return array アップロードした画像のID
     */
    protected function uploadFlickr($files, $title)
    {
        $flickrService = $this->flickrService;

        $flickrIds = [];
        foreach ($files as $file) {
            if (is_null($file)) {
                continue;
            }

            DB::transaction(function () use ($flickrService, $title, &$flickrIds, $file) {
                $flickr = $flickrService->upload($file->getRealPath(), $title);
                $flickrIds[] = $flickr->id;
            });
        }

        return $flickrIds;
    }

    /**
     * 作成処理
     * @param TextDiaryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TextDiaryRequest $request)
    {
        $flickrIds = $this->uploadFlickr($request->file('picture'), $request->input('title'));

        $textDiary = new TextDiary();

        DB::transaction(function () use ($request, &$flickrIds, $textDiary) {
            // 日記登録
            $textDiary->fill($request->all());
            $textDiary->save();

            // カテゴリ紐付け
            $textDiary->textDiaryCategories()->attach($request->input('categoryIds'));

            // Flickr保存・紐付け
            $textDiary->flickrs()->attach($flickrIds);
        });

        return redirect()->back()->with('newEntity', $textDiary);
    }

    /**
     * 編集画面
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $categoryOptions = TextDiaryCategory::orderBy('display_order')->lists('name', 'id');
        $textDiary = TextDiary::findOrFail($id);

        return view('textDiary.edit', compact('categoryOptions', 'textDiary'));
    }

    /**
     * 更新処理
     * @param $id
     * @param TextDiaryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, TextDiaryRequest $request)
    {
        $textDiary = TextDiary::findOrFail($id);

        $flickrIds = $this->uploadFlickr($request->file('picture'), $request->input('title'));

        DB::transaction(function () use ($request, &$flickrIds, $textDiary) {
            // 日記登録
            $textDiary->fill($request->all());
            $textDiary->save();

            // カテゴリ紐付け
            $textDiary->textDiaryCategories()->sync($request->input('categoryIds'));

            if ($request->has('flickrIds')) {
                $flickrIds = array_merge($flickrIds, $request->input('flickrIds'));
            }

            // Flickr紐付け更新
            $textDiary->flickrs()->sync($flickrIds);
        });

        return redirect('textDiary');
    }

    /**
     * 削除処理
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        TextDiary::destroy($id);

        return redirect('textDiary');
    }
}