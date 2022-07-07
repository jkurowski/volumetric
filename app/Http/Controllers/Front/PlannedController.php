<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Page;

class PlannedController extends Controller
{

    public function index()
    {
        return view('front.planned.index', [
            'planned' => Investment::where('status', 3)->orderBy('sort', 'ASC')->get(),
            'page' => Page::where('id', 3)->first()
        ]);
    }
}
