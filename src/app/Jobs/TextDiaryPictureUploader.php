<?php

namespace App\Jobs;

use App\Jobs\Traits\FlickrUploader;
use App\Models\TextDiary;
use DB;
use File;
use Illuminate\Contracts\Bus\SelfHandling;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class TextDiaryPictureUploader extends Job implements SelfHandling
{
    use FlickrUploader;

    protected $textDiary;

    protected $pictures;

    protected $title;

    /**
     * Create a new job instance.
     * @param TextDiary $textDiary
     * @param $pictures
     * @param $title
     */
    public function __construct(TextDiary $textDiary, $pictures, $title)
    {
        $this->textDiary = $textDiary;
        $this->title = $title;
        $this->pictures = [];

        /** @var UploadedFile $temp */
        foreach ($pictures as $temp) {
            $name = sha1(uniqid(mt_rand(), true)) . '.' . $temp->getClientOriginalExtension();
            $this->pictures[] = $temp->move(storage_path('temp/flickr'), $name);
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $flickrIds = [];

        foreach ($this->pictures as $picture) {
            DB::transaction(function () use ($picture, &$flickrIds) {
                // Flickrにアップロード
                $flickrIds[] = $this->uploadFlickr($picture, $this->title)->id;

                $this->textDiary->flickrs()->attach($flickrIds);
            });

            // 一時ファイルを削除
            File::delete($picture);
        }
    }
}
