<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class BoxService
{
    public function upload(string $title, UploadedFile $file, object $model, bool $delete = false)
    {
        if ($delete) {
            if (File::isFile(public_path(config('images.box.file_path') . $model->file))) {
                File::delete(public_path(config('images.box.file_path') . $model->file));
            }
        }

        $name = date('His').'_'.Str::slug($title).'.' . $file->getClientOriginalExtension();
        $file->storeAs('boxes', $name, 'public_uploads');
        $filepath = public_path(config('images.box.file_path') . $name);

        Image::make($filepath)
            ->fit(
                config('images.box.width'),
                config('images.box.height')
            )->save($filepath);

        $model->update(['file' => $name]);
    }
}
