<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\FloorRepository;
use App\Models\Floor;
use App\Models\Investment;
use App\Models\Page;

class InvestmentFloorController extends Controller
{
    private $repository;

    public function __construct(FloorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Investment $investment, Floor $floor, Request $request)
    {
        $investment_room = $investment->load(array(
            'floorRooms' => function ($query) use ($floor, $request) {
                $query->where('floor_id', $floor->id);
                if ($request->input('rooms')) {
                    $query->where('rooms', $request->input('rooms'));
                }
                if ($request->input('status')) {
                    $query->where('status', $request->input('status'));
                }
                if ($request->input('area')) {
                    $area_param = explode('-', $request->input('area'));
                    $min = $area_param[0];
                    $max = $area_param[1];
                    $query->whereBetween('area', [$min, $max]);
                }
                if ($request->input('sort')) {
                    $order_param = explode(':', $request->input('sort'));
                    $column = $order_param[0];
                    $direction = $order_param[1];
                    $query->orderBy($column, $direction);
                }
            },
            'floor' => function ($query) use ($floor) {
                $query->where('id', $floor->id);
            }
        ));

        $page = Page::where('id', 13)->first();

        return view('front.investment_floor.index', [
            'investment' => $investment_room,
            'properties' => $investment_room->floorRooms,
            'uniqueRooms' => $this->repository->getUniqueRooms($floor->properties()),
            'next_floor' => $floor->findNext($investment->id, null, $floor->id),
            'prev_floor' => $floor->findPrev($investment->id, null, $floor->id),
            'page' => $page
        ]);
    }
}
