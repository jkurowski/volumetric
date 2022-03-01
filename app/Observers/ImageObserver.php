<?php

namespace App\Observers;

use Illuminate\Support\Facades\File;

// CMS
use App\Models\Image;

class ImageObserver
{
    /**
     * Handle the image "deleted" event.
     *
     * @param  Image $image
     * @return void
     */
    public function deleted(Image $image)
    {
        if ($image->file) {
            $image_path = public_path(config('images.gallery.file_path') . $image->file);
            $image_thumb_path = public_path(config('images.gallery.thumb_file_path') . $image->file);

            if (File::isFile($image_path)) {
                File::delete($image_path);
            }

            if (File::isFile($image_thumb_path)) {
                File::delete($image_thumb_path);
            }
        }
    }
}
