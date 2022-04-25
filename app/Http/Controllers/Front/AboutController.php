<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

// CMS
use App\Models\Inline;
use App\Models\Investment;
use App\Models\Page;

class AboutController extends Controller
{
    public function index()
    {
        return view('front.about.index', [
            'about_investments' => Investment::where('status', '!=' , 2)->get(),
            'page' => Page::where('id', 1)->first(),
            'array' => Inline::getElements(1)
        ]);
    }

}
