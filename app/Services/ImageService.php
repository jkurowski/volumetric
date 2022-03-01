<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as ImageManager;

class ImageService
{
    public function upload(UploadedFile $file, object $model, bool $delete = false)
    {

        if ($delete) {
            if (File::isFile(public_path(config('images.gallery.file_path') . $model->file))) {
                File::delete(public_path(config('images.gallery.file_path') . $model->file));
            }
            if (File::isFile(public_path(config('images.gallery.thumb_file_path') . $model->file))) {
                File::delete(public_path(config('images.gallery.thumb_file_path') . $model->file));
            }
        }
        $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $name = date('His').'_'.Str::slug($file_name).'.' . $file->getClientOriginalExtension();
        $file->storeAs('gallery/images/', $name, 'public_uploads');

        $filepath = public_path(config('images.gallery.file_path') . $name);
        $thumb_filepath = public_path(config('images.gallery.thumb_file_path') . $name);

        ImageManager::make($filepath)
            ->fit(
                config('images.gallery.big_width'),
                config('images.gallery.big_height')
            )->save($filepath);
        ImageManager::make($filepath)
            ->fit(
                config('images.gallery.thumb_width'),
                config('images.gallery.thumb_height')
            )->save($thumb_filepath);

        $model->update([
            'file' => $name,
            'name' => $file->getClientOriginalName()
        ]);
    }
}
