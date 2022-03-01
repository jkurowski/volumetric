<?php

namespace App\Observers;

use Illuminate\Support\Facades\File;

// CMS
use App\Models\Boxes;

class BoxObserver
{
    /**
     * Handle the box "deleted" event.
     *
     * @param Boxes $boxes
     * @return void
     */
    public function deleted(Boxes $boxes)
    {
        $file = public_path(config('images.box.file_path') . $boxes->file);

        if (File::isFile($file)) {
            File::delete($file);
        }
    }
}
