<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use App\Investment;
use App\Building;
use App\Floor;
use App\Property;


class InvestmentBuildingPropertyController extends Controller
{
    public function index(Investment $investment, Building $building, Floor $floor, Property $property)
    {
        return view('front.investment_property.index', ['investment' => $investment, 'building' => $building, 'floor' => $floor, 'property' => $property]);
    }
}
