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
        $file = public_path(config('images.article.file_path') . $article->file);
        $file_thumb = public_path(config('images.article.thumb_file_path') . $article->file);
        $facebook_thumb = public_path('uploads/articles/share/' . $article->file_facebook);

        if (File::isFile($file)) {
            File::delete($file);
        }
        if (File::isFile($file_thumb)) {
            File::delete($file_thumb);
        }
        if (File::isFile($facebook_thumb)) {
            File::delete($facebook_thumb);
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
