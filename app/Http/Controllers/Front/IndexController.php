<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

// CMS
use App\Models\Investment;
use App\Models\Slider;

class IndexController extends Controller
{

    public function index()
    {
        $sliders = Slider::all()->sortBy("sort");
        $investments = Investment::where('status', 1)->get();

        return view('front.homepage.index', compact(
            [
                'sliders',
                'investments'
            ]
        ));
    }
}
