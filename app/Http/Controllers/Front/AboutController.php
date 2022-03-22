<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Page;

class AboutController extends Controller
{
    public function index()
    {
        $page = Page::where('id', 1)->first();
        $investments = Investment::where('status', 1)->get();

        return view('front.about.index', [
            'investments' => $investments,
            'page' => $page
        ]);
    }

}
