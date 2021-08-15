<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

//CMS
use App\Models\Slider;

class SliderService
{
    public function upload(string $title, UploadedFile $file, Slider $model, bool $delete = false)
    {

        if ($delete) {
            if (File::isFile(public_path('uploads/slider/' . $model->file))) {
                File::delete(public_path('uploads/slider/' . $model->file));
            }
            if (File::isFile(public_path('uploads/slider/thumbs/' . $model->file))) {
                File::delete(public_path('uploads/slider/thumbs/' . $model->file));
            }
        }

        $name = date('His').'_'.Str::slug($title, '-').'.' . $file->getClientOriginalExtension();
        $file->storeAs('slider', $name, 'public_uploads');

        $filepath = public_path('uploads/slider/' . $name);
        $thumb_filepath = public_path('uploads/slider/thumbs/' . $name);

        Image::make($filepath)->fit(Slider::IMG_WIDTH, Slider::IMG_HEIGHT)->save($filepath);
        Image::make($filepath)->fit(Slider::THUMB_WIDTH, Slider::THUMB_HEIGHT)->save($thumb_filepath);

        $model->update(['file' => $name]);
    }
}
