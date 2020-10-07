<?php

namespace App\Http\Controllers\Admin;

use App\Building;
use App\Floor;
use App\Investment;

use App\Http\Controllers\Controller;
use App\Http\Requests\FloorFormRequest;

class InvestmentBuildingFloorController extends Controller
{
    public function index(Building $building)
    {
        $investment = Investment::find($building->investment_id);
        $floors = Floor::where('building_id', $building->id)->withCount('properties')->get();

        return view('admin.investment_building_floor.index', [
            'investment' => $investment,
            'list' => $floors,
            'building' => $building
        ]);
    }

    public function create(Building $building)
    {
        $investment = Investment::find($building->investment_id);

        return view('admin.investment_building_floor.form', [
            'cardTitle' => 'Dodaj pietro',
            'backButton' => route('admin.developro.building.floor.index', $building),
            'planwidth' => Building::PLAN_WIDTH,
            'planheight' => Building::PLAN_HEIGHT,
            'building' => $building,
            'investment' => $investment,
        ])->with('entry', Building::make());
    }

    public function store(FloorFormRequest $request, Building $building)
    {
        $floor = Floor::create($request->merge([
            'investment_id' => $building->investment_id,
            'building_id' => $building->id,
        ])->only([
            'investment_id',
            'building_id',
            'type',
            'name',
            'cords',
            'html'
        ]));

        if ($request->hasFile('file')) {
            $floor->planUpload($request->name, $request->file('file'));
        }

        return redirect()->route('admin.developro.building.floor.index', $building)->with('success', 'Nowe piętro dodane');
    }

    public function edit(Floor $floor)
    {
        $investment = Investment::where('id', $floor->investment_id)->first();
        $building = Building::where('id', $floor->building_id)->first();

        return view('admin.investment_building_floor.form', [
            'cardTitle' => 'Edytuj pietro',
            'backButton' => route('admin.developro.building.floor.index', $floor->building_id),
            'planwidth' => Floor::PLAN_WIDTH,
            'planheight' => Floor::PLAN_HEIGHT,
            'entry' => $floor,
            'building' => $building,
            'investment' => $investment
        ]);
    }

    public function update(FloorFormRequest $request, Floor $floor)
    {
        $floor->update($request->only(
            [
                'type',
                'name',
                'cords',
                'html'
            ]
        ));

        if ($request->hasFile('file')) {
            $floor->planUpload($request->name, $request->file('file'), true);
        }

        return redirect()->route('admin.developro.building.floor.index', $floor->building_id)->with('success', 'Pietro zaktualizowane');
    }

    public function destroy(Floor $floor)
    {
        $floor->delete();
        return response()->json(['success' => 'Piętro usniete']);
    }
}
