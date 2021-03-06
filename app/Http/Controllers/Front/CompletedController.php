<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Inline;
use App\Models\Investment;
use App\Models\Page;

class CompletedController extends Controller
{

    public function index()
    {
        return view('front.completed.index', [
            'about_investments' => Investment::with('photos')->where('status', '=' , 2)->orderBy('sort', 'ASC')->get(),
            'images' => Image::all(),
            'page' => Page::where('id', 5)->first(),
            'array' => Inline::getElements(1)
        ]);
    }
}
