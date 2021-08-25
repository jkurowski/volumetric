<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

//CMS
use App\Models\Article;

class ArticleService
{
    public function upload(string $title, UploadedFile $file, object $model, bool $delete = false)
    {

        if ($delete) {
            if (File::isFile(public_path('uploads/articles/' . $model->file))) {
                File::delete(public_path('uploads/articles/' . $model->file));
            }
            if (File::isFile(public_path('uploads/articles/thumbs/' . $model->file))) {
                File::delete(public_path('uploads/articles/thumbs/' . $model->file));
            }
        }

        $name = date('His').'_'.Str::slug($title).'.' . $file->getClientOriginalExtension();
        $file->storeAs('articles', $name, 'public_uploads');

        $filepath = public_path('uploads/articles/' . $name);
        $thumb_filepath = public_path('uploads/articles/thumbs/' . $name);

        Image::make($filepath)->fit(Article::IMG_WIDTH, Article::IMG_HEIGHT)->save($filepath);
        Image::make($filepath)->fit(Article::THUMB_WIDTH, Article::THUMB_HEIGHT)->save($thumb_filepath);

        $model->update(['file' => $name]);
    }

    public function uploadFileFacebook(string $title, UploadedFile $file, object $model, bool $delete = false)
    {

        if ($delete) {
            if (File::isFile(public_path('uploads/articles/share/' . $model->file_facebook))) {
                File::delete(public_path('uploads/articles/share/' . $model->file_facebook));
            }
        }

        $name = date('His').'_'.Str::slug($title).'.' . $file->getClientOriginalExtension();
        $file->storeAs('articles/share', $name, 'public_uploads');
        $filepath = public_path('uploads/articles/share/' . $name);
        Image::make($filepath)->fit(600, 314)->save($filepath);

        $model->update(['file_facebook' => $name]);
    }
}
