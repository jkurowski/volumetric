<?php

namespace App\Observers;

use Illuminate\Support\Facades\File;

// CMS
use App\Models\Gallery;

class GalleryObserver
{
    /**
     * Handle the gallery "deleted" event.
     *
     * @param  Gallery $gallery
     * @return void
     */
    public function deleted(Gallery $gallery)
    {
        foreach ($gallery->photos as $photo) {
            if ($photo->file) {
                $image_path = public_path(config('images.gallery.file_path') . $photo->file);
                $image_thumb_path = public_path(config('images.gallery.thumb_file_path') . $photo->file);

                if (File::isFile($image_path)) {
                    File::delete($image_path);
                }

                if (File::isFile($image_thumb_path)) {
                    File::delete($image_thumb_path);
                }
            }
        }
        $gallery->photos()->delete();
    }
}
