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
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Input;
use Validator;

class TextDiaryController extends Controller
{
    public function index()
    {
        // カテゴリ毎の日記件数
        $dairyCount = DB::table('text_diary_text_diary_category')
            ->select('text_diary_category_id', DB::raw('count(*) as count'))
            ->groupBy('text_diary_category_id')
            ->lists('count', 'text_diary_category_id');

        // 日記が存在するカテゴリ
        $categories = TextDiaryCategory::whereIn('id', array_keys($dairyCount))->orderBy('display_order')->get();

        $textDiaries = TextDiary::with('textDiaryCategories')->with('flickrs')->orderBy('datetime', 'desc')->get();

        return view('textDiary.index', compact('categories', 'dairyCount', 'textDiaries'));
    }

    public function create()
    {
        $categoryOptions = options(TextDiaryCategory::orderBy('display_order')->get());

        return view('textDiary.create', compact('categoryOptions'));
    }

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
            $textDiary->datetime = Carbon::createFromFormat(config('format.datetime'), $request->datetime);
            $textDiary->save();

            // カテゴリ紐付け
            $textDiary->textDiaryCategories()->attach($request->category);

            // Flickr保存・紐付け
            $textDiary->flickrs()->attach($flickrIds);
        });

        return redirect()->back()->with('newEntity', $textDiary);
    }
}