<?php

namespace App\Http\Controllers\Front;

use App\Article;
use App\Http\Controllers\Controller;
use App\Slider;

class IndexController extends Controller
{

    public function index()
    {
        $sliders = Slider::all()->sortBy("sort");
        $articles = Article::all()->sortBy("sort");

        return view('front.homepage.index', compact('sliders', 'articles'));
    }

}
