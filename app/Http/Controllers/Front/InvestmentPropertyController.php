<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Floor;
use App\Models\Property;
use App\Models\RodoRules;

class InvestmentPropertyController extends Controller
{
    public function index(Investment $investment, Floor $floor, Property $property)
    {
        return view('front.investment_property.index', [
            'investment' => $investment,
            'floor' => $floor,
            'property' => $property,
            'rules' => RodoRules::orderBy('sort')->whereStatus(1)->get()
        ]);
    }
}
