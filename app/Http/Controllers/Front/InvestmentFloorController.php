<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use App\Models\Floor;
use App\Models\Investment;
use Illuminate\Http\Request;

class InvestmentFloorController extends Controller
{
    public function index(Investment $investment, Floor $floor, Request $request)
    {

        $investment_room = $investment->load(array(
            'floorRooms' => function($query) use ($floor, $request)
            {
                $query->where('floor_id', $floor->id);
                if ($request->input('rooms')) {
                    $query->where('rooms', $request->input('rooms'));
                }
                if ($request->input('status')) {
                    $query->where('status', $request->input('status'));
                }
                if ($request->input('sort')) {
                    $order_param = explode(':', $request->input('sort'));
                    $column = $order_param[0];
                    $direction = $order_param[1];
                    $query->orderBy($column, $direction);
                }
            },
            'floor' => function($query) use ($floor)
            {
                $query->where('id', $floor->id);
            }
        ));

        return view('front.investment_floor.index', [
            'investment' => $investment_room,
            'properties' => $investment_room->floorRooms,
            'next_floor' => $floor->findNext($investment->id, null, $floor->id),
            'prev_floor' => $floor->findPrev($investment->id, null, $floor->id)
        ]);
    }

}
