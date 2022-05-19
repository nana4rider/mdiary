<?php
/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/28
 * Time: 22:49
 */

namespace App\Http\Controllers;

use App\Http\Requests\TextDiaryUpsertRequest;
use App\Jobs\TextDiaryPictureUploader;
use App\Models\TextDiary;
use App\Models\TextDiaryCategory;
use DB;
use Illuminate\Http\Request;

class TextDiaryController extends Controller
{
    /**
     * 一覧表示
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // カテゴリ
        $categories = TextDiaryCategory::orderBy('display_order')->get();

        $builder = TextDiary::with('textDiaryCategories')->with('flickrs');

        if ($request->has('category')) {
            $builder->whereHas('textDiaryCategories', function ($query) use ($request) {
                // 選択したカテゴリで絞込
                $query->where('id', '=', $request->input('category'));
            });
        }

        $textDiaries = $builder->latest('datetime')->paginate(config('const.max_text_diary'));

        return view('textDiary.index', compact('categories', 'textDiaries'));
    }

    /**
     * 作成画面
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = TextDiaryCategory::orderBy('display_order');

        return view('textDiary.create', compact('categories'));
    }

    /**
     * 作成処理
     *
     * @param TextDiaryUpsertRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TextDiaryUpsertRequest $request)
    {
        $textDiary = new TextDiary();

        DB::transaction(function () use ($request, $textDiary) {
            // 日記登録
            $textDiary->fill($request->all());
            $textDiary->save();

            // カテゴリ紐付け
            $textDiary->textDiaryCategories()->attach($request->input('category_ids'));
        });

        // Flickerにアップロード
        if (!empty($request->file('picture')[0])) {
            $this->dispatch(new TextDiaryPictureUploader($textDiary->id,
                $request->file('picture'), $request->input('title')));
        }

        return redirect()->route('textDiary.index')->with('complete', 'post');
    }

    /**
     * 編集画面
     *
     * @param TextDiary $textDiary
     * @return \Illuminate\View\View
     */
    public function edit(TextDiary $textDiary)
    {
        $categories = TextDiaryCategory::orderBy('display_order');

        return view('textDiary.edit', compact('categories', 'textDiary'));
    }

    /**
     * 更新処理
     *
     * @param TextDiary $textDiary
     * @param TextDiaryUpsertRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(TextDiary $textDiary, TextDiaryUpsertRequest $request)
    {
        DB::transaction(function () use ($request, $textDiary) {
            // 日記登録
            $textDiary->fill($request->all());
            $textDiary->save();

            // カテゴリ紐付け
            $textDiary->textDiaryCategories()->sync($request->input('category_ids'));

            // Flickr紐付け更新
            if ($request->has('flickr_ids')) {
                $textDiary->flickrs()->sync($request->input('flickr_ids'));
            } else {
                $textDiary->flickrs()->detach();
            }
        });

        // Flickerにアップロード
        if (!empty($request->file('picture')[0])) {
            $this->dispatch(new TextDiaryPictureUploader($textDiary->id,
                $request->file('picture'), $request->input('title')));
        }

        return redirect()->route('textDiary.index')->with('complete', 'update');
    }

    /**
     * 削除処理
     *
     * @param TextDiary $textDiary
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(TextDiary $textDiary)
    {
        $textDiary->delete();

        return redirect()->route('textDiary.index')->with('complete', 'destroy');
    }
}