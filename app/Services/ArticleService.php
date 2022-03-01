<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class ArticleService
{
    public function upload(string $title, UploadedFile $file, object $model, bool $delete = false)
    {

        if ($delete) {
            if (File::isFile(public_path(config('images.article.file_path') . $model->file))) {
                File::delete(public_path(config('images.article.file_path') . $model->file));
            }
            if (File::isFile(public_path(config('images.article.thumb_file_path') . $model->file))) {
                File::delete(public_path(config('images.article.thumb_file_path') . $model->file));
            }
        }

        $name = date('His').'_'.Str::slug($title).'.' . $file->getClientOriginalExtension();
        $file->storeAs('articles', $name, 'public_uploads');

        $filepath = public_path(config('images.article.file_path') . $name);
        $thumb_filepath = public_path(config('images.article.thumb_file_path') . $name);

        Image::make($filepath)
            ->fit(
                config('images.article.big_width'),
                config('images.article.big_height')
            )->save($filepath);

        Image::make($filepath)
            ->fit(
                config('images.article.thumb_width'),
                config('images.article.thumb_height')
            )->save($thumb_filepath);

        $model->update(['file' => $name]);
    }

    public function uploadFileFacebook(string $title, UploadedFile $file, object $model, bool $delete = false)
    {
        if ($delete) {
            if (File::isFile(public_path(config('images.article.facebook_file_path') . $model->file_facebook))) {
                File::delete(public_path(config('images.article.facebook_file_path') . $model->file_facebook));
            }
        }

        $name = date('His').'_'.Str::slug($title).'.' . $file->getClientOriginalExtension();
        $file->storeAs('articles/share', $name, 'public_uploads');
        $filepath = public_path(config('images.article.facebook_file_path') . $name);
        Image::make($filepath)->fit(600, 314)->save($filepath);

        $model->update(['file_facebook' => $name]);
    }
}
