<?php

namespace App\Http\Controllers\Admin\Developro;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyFormRequest;
use Illuminate\Support\Facades\Session;

use App\Models\Investment;
use App\Models\Building;
use App\Models\Floor;
use App\Models\Property;

class BuildingPropertyController extends Controller
{

    public function index(Investment $investment, Building $building, Floor $floor)
    {
        $properties = Property::where('floor_id', $floor->id)->get();

        return view('admin.investment_building_property.index', [
            'investment' => $investment,
            'building' => $building,
            'floor' => $floor,
            'list' => $properties
        ]);
    }

    public function create(Investment $investment, Building $building, Floor $floor)
    {

        return view('admin.investment_building_property.form', [
            'cardTitle' => 'Dodaj mieszkanie',
            'backButton' => route('admin.developro.investment.building.floor.property.index', [$investment, $building, $floor]),
            'floor' => $floor,
            'building' => $building,
            'investment' => $investment,
            'planwidth' => Property::PLAN_WIDTH,
            'planheight' => Property::PLAN_HEIGHT,
        ])->with('entry', Property::make());
    }

    public function store(PropertyFormRequest $request, Investment $investment, Building $building, Floor $floor)
    {
        $property = Property::create($request->merge([
            'investment_id' => $investment->id,
            'building_id' => $building->id,
            'floor_id' => $floor->id
        ])->only([
            'investment_id',
            'building_id',
            'floor_id',
            'type',
            'rooms',
            'status',
            'area',
            'name',
            'cords',
            'html'
        ]));

        if ($request->hasFile('file')) {
            $property->planUpload($request->name, $request->file('file'));
        }

        return redirect()->route('admin.developro.investment.building.floor.property.index', [$investment, $building, $floor])->with('success', 'Powierzchnia zapisana');
    }

    public function edit(Investment $investment, Building $building, Floor $floor, $id)
    {

        $property = Property::find($id);

        return view('admin.investment_building_property.form', [
            'cardTitle' => 'Edytuj mieszkanie',
            'backButton' => route('admin.developro.investment.building.floor.property.index', [$investment, $building, $floor]),
            'floor' => $floor,
            'building' => $building,
            'investment' => $investment,
            'entry' => $property,
            'planwidth' => Property::PLAN_WIDTH,
            'planheight' => Property::PLAN_HEIGHT,
        ]);
    }

    public function update(PropertyFormRequest $request, Investment $investment, Building $building, Floor $floor,Property $property)
    {
        $property->update($request->only([
            'rooms',
            'status',
            'area',
            'name',
            'cords',
            'html'
        ]));

        if ($request->hasFile('file')) {
            $property->planUpload($request->name, $request->file('file'), true);
        }

        return redirect()->route('admin.developro.investment.building.floor.property.index', [$investment, $building, $floor])->with('success', 'Powierzchnia zaktualizowana');
    }

    public function destroy($investment, $building, $floor, $id)
    {
        $property = Property::find($id);
        $property->delete();
        Session::flash('success', 'Powierzchnia usunięta');
        return response()->json('Deleted', 200);
    }
}
