<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

//CMS

class InvestmentService
{
    public function uploadThumb(string $title, UploadedFile $file, object $model, bool $delete = false)
    {

        if ($delete) {
            if (File::isFile(public_path(config('images.investment.file_path') . $model->file_thumb))) {
                File::delete(public_path(config('images.investment.file_path') . $model->file_thumb));
            }

            if (File::isFile(public_path(config('images.investment.thumb_file_path') . $model->file_thumb))) {
                File::delete(public_path(config('images.investment.thumb_file_path') . $model->file_thumb));
            }
        }

        $name = date('His').'_'.Str::slug($title).'.' . $file->getClientOriginalExtension();
        $file->storeAs('investments', $name, 'public_uploads');

        $filepath = public_path(config('images.investment.file_path') . $name);
        $thumb_filepath = public_path(config('images.investment.thumb_file_path') . $name);

        Image::make($filepath)
            ->fit(
                config('images.investment.thumb_width'),
                config('images.investment.thumb_height')
            )->save($thumb_filepath);

        $model->update(['file_thumb' => $name]);
    }

    public function uploadCarousel(string $title, UploadedFile $file, object $model, bool $delete = false)
    {

        if ($delete) {
            if (File::isFile(public_path(config('images.investment.carousel_file_path') . $model->file_carousel))) {
                File::delete(public_path(config('images.investment.carousel_file_path') . $model->file_carousel));
            }
        }

        $name = date('His').'_'.Str::slug($title).'.' . $file->getClientOriginalExtension();
        $file->storeAs('investments/carousel', $name, 'public_uploads');

        $filepath = public_path(config('images.investment.carousel_file_path') . $name);

        Image::make($filepath)
            ->fit(
                config('images.investment.carousel_width'),
                config('images.investment.carousel_height')
            )->save($filepath);

        $model->update(['file_carousel' => $name]);
    }
}
