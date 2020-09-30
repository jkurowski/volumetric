<?php

namespace App\Http\Controllers\Front;

use App\Floor;
use App\Http\Controllers\Controller;
use App\Investment;
use App\Property;


class InvestmentPropertyController extends Controller
{
    public function index(Investment $investment, Floor $floor, Property $property)
    {
        return view('front.investment_property.index', ['investment' => $investment, 'floor' => $floor, 'property' => $property]);
    }
}
