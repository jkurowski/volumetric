<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Investment;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{

    public function index()
    {
        return view('front.investment.index', ['list' => Investment::all()]);
    }

    public function show(Investment $investment, Request $request)
    {
        /**
         * Inwestycja osiedlowa
         */
        if ($investment->type == 1) {
            $investment_room = $investment->load(array(
                'buildingRooms' => function($query) use ($request)
                {
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
                'plan'
            ));

            $properties = $investment_room->buildingRooms;
        }

        /**
         * Inwestycja z jednym budynkiem
         */
        if ($investment->type == 2) {
            $investment_room = $investment->load(array(
                'floorRooms' => function($query) use ($request)
                {
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
                'plan'
            ));

            $properties = $investment_room->floorRooms;
        }

        /**
         * Inwestycja z domami
         */
        if ($investment->type == 3) {
            $investment_room = $investment->load(array(
                'houses' => function($query) use ($request)
                {
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
                }
            ));

            $properties = $investment_room->houses;
        }
        return view('front.investment.show', ['investment' => $investment, 'properties' => $properties]);
    }

}
