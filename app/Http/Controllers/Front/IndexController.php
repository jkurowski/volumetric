<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

// CMS
use App\Models\Gallery;
use App\Models\Inline;
use App\Models\Slider;

class IndexController extends Controller
{

    public function index()
    {
        $sliders = Slider::all()->sortBy("sort");
        $gallery = Gallery::with('photos')->find(1);
        $array = Inline::getElements(2);

        return view('front.homepage.index', compact(
            [
                'sliders',
                'gallery',
                'array'
            ]
        ));
    }
}
