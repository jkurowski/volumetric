<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Page;

class MenuController extends Controller
{
    public function index($uri = null)
    {
        $page = Page::where('uri', $uri)->firstOrFail();
        return view('front.menupage.index')->with('page', $page);
    }

}
