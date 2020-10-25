<?php

namespace App\Observers;

use App\Image;

class ImageObserver
{
    /**
     * Handle the image "deleted" event.
     *
     * @param  \App\Image  $image
     * @return void
     */
    public function deleted(Image $image)
    {
        if ($image->file) {
            $image_path = public_path('uploads/gallery/images/' . $image->file);
            $image_thumb_path = public_path('uploads/gallery/images/thumbs/' . $image->file);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            if (file_exists($image_thumb_path)) {
                unlink($image_thumb_path);
            }
        }
    }
}
