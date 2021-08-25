<?php

namespace App\Observers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

// CMS
use App\Models\Article;

class ArticleObserver
{
    /**
     * Handle the article "deleted" event.
     *
     * @param Article $article
     * @return void
     */
    public function deleted(Article $article)
    {
        $file = public_path('uploads/articles/' . $article->file);
        $file_thumb = public_path('uploads/articles/thumbs/' . $article->file);

        if (File::isFile($file)) {
            File::delete($file);
        }
        if (File::isFile($file_thumb)) {
            File::delete($file_thumb);
        }
    }

    /**
     * Handle the article "saving" event.
     *
     * @param Article $article
     * @return void
     */
    public function saving(Article $article)
    {
        $article->slug = Str::slug($article->title);
    }
}
