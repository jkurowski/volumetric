<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlannedController extends Controller
{

    public function index()
    {
        return view('front.planned.index', [
            'planned' => Investment::where('status', 3)->get(),
            'page' => Page::where('id', 3)->first()
        ]);
    }
}
