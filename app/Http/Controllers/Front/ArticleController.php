<?php

namespace App\Http\Controllers\Front;

use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function index()
    {

        return view('front.article.index', ['articles' => Article::orderBy('sort', 'asc')->get()]);
    }

    public function show($slug)
    {

        $article = Article::where('slug', $slug)->first();

        return view('front.article.show', [
            'article' => $article
        ]);
    }
}
