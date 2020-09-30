<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Investment;
use App\Property;

class InvestmentHouseController extends Controller
{
    public function index(Investment $investment, Property $property)
    {
        return view('front.investment_house.index', ['investment' => $investment, 'property' => $property]);
    }
}
