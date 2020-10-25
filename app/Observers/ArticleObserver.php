<?php

namespace App\Observers;

use App\Models\Article;

class ArticleObserver
{
    /**
     * Handle the article "deleted" event.
     *
     * @param  \App\Article  $article
     * @return void
     */
    public function deleted(Article $article)
    {
        if($article->file) {
            $article_img = public_path('uploads/articles/' . $article->file);
            $article_thumb_img = public_path('uploads/articles/thumbs/' . $article->file);

            if (file_exists($article_img)) {
                unlink($article_img);
            }
            if (file_exists($article_thumb_img)) {
                unlink($article_thumb_img);
            }
        }
    }
}
