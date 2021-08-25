<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;

// CMS
use OpenGraph;
use Spatie\SchemaOrg\Schema;

class ArticleController extends Controller
{

    public function index()
    {
        return view('front.article.index', ['articles' => Article::orderBy('sort', 'asc')->get()]);
    }

    public function show($slug)
    {

        $article = Article::where('slug', $slug)->first();

        $schemaBlog = Schema::BlogPosting()
            ->mainEntityOfPage(Schema::WebPage()->identifier(route('front.news.show', $article->slug)))
            ->headline($article->title)
            ->description($article->content_entry)
            ->datePublished($article->created_at)
            ->dateModified($article->updated_at)
            ->image(Schema::imageObject()->url(asset('uploads/articles/'.$article->file))
                ->height(Article::IMG_HEIGHT)
                ->width(Article::IMG_WIDTH))
            ->author(Schema::person()->name('Autor'));

        $og = OpenGraph::title($article->title)
            ->type('article')
            ->image('http://developro.4dl-dev.pl/public/uploads/articles/share/'.$article->file, [
                'width' => 600,
                'height' => 314
            ])
            ->description($article->content_entry)
            ->url();

        return view('front.article.show', [
            'article' => $article,
            'schema' => $schemaBlog,
            'opengraph' => $og
        ]);
    }
}
