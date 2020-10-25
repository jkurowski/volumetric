<?php

namespace App\Http\Controllers\Admin\Developro;

use App\Http\Controllers\Controller;
use App\Http\Requests\FloorFormRequest;
use Illuminate\Support\Facades\Session;

use App\Models\Building;
use App\Models\Floor;
use App\Models\Investment;

class BuildingFloorController extends Controller
{
    public function index(Investment $investment, Building $building)
    {
        $floors = Floor::where('building_id', $building->id)->withCount('properties')->get(['id', 'name']);

        return view('admin.investment_building_floor.index', [
            'investment' => $investment,
            'building' => $building,
            'list' => $floors
        ]);
    }

    public function create(Investment $investment, Building $building)
    {
        return view('admin.investment_building_floor.form', [
            'cardTitle' => 'Dodaj pietro',
            'backButton' => route('admin.developro.investment.building.floor.index', [$investment, $building]),
            'planwidth' => Building::PLAN_WIDTH,
            'planheight' => Building::PLAN_HEIGHT,
            'building' => $building,
            'investment' => $investment,
        ])->with('entry', Building::make());
    }

    public function store(FloorFormRequest $request, Investment $investment, Building $building)
    {
        $floor = Floor::create($request->merge([
            'investment_id' => $investment->id,
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

        return redirect()->route('admin.developro.investment.building.floor.index', [$investment, $building])->with('success', 'Nowe piętro dodane');
    }

    public function edit(Investment $investment, Building $building, Floor $floor)
    {
        return view('admin.investment_building_floor.form', [
            'cardTitle' => 'Edytuj pietro',
            'backButton' => route('admin.developro.investment.building.floor.index', [$investment, $building]),
            'planwidth' => Floor::PLAN_WIDTH,
            'planheight' => Floor::PLAN_HEIGHT,
            'entry' => $floor,
            'building' => $building,
            'investment' => $investment
        ]);
    }

    public function update(FloorFormRequest $request, Investment $investment, Building $building, Floor $floor)
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

        return redirect()->route('admin.developro.investment.building.floor.index', [$investment, $building])->with('success', 'Pietro zaktualizowane');
    }

    public function destroy($investment, $building, $id)
    {
        $floor = Floor::find($id);
        $floor->delete();
        Session::flash('success', 'Piętro usunięte');
        return response()->json('Deleted', 200);
    }
}
