<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Floor;
use App\Models\Page;
use App\Models\Property;
use App\Models\RodoRules;

class InvestmentPropertyController extends Controller
{
    public function index(Investment $investment, Floor $floor, Property $property)
    {

        $page = Page::where('id', 13)->first();

        return view('front.investment_property.index', [
            'investment' => $investment,
            'floor' => $floor,
            'property' => $property,
            'rules' => RodoRules::orderBy('sort')->whereStatus(1)->get(),
            'page' => $page
        ]);
    }
}
