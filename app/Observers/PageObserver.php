<?php

namespace App\Observers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

// CMS
use App\Models\Page;

class PageObserver
{

    /**
     * Handle the article "saving" event.
     *
     * @param Page $page
     * @return void
     */
    public function saving(Page $page)
    {
        $page->slug = Str::slug($page->title);

        if ($page->parent_id) {
            $array = Page::ancestorsOf($page->id)->pluck('slug')->toArray();
            array_push($array, $page->slug);
            $page->uri = implode('/', $array);
        } else {
            $page->uri = $page->slug;
        }
    }

    /**
     * Handle the image "deleted" event.
     *
     * @param Page $page
     * @return void
     */
    public function deleted(Page $page)
    {
        if ($page->file) {
            $image_path = public_path(config('images.page.file_path') . $page->file);

            if (File::isFile($image_path)) {
                File::delete($image_path);
            }
        }
    }
}
