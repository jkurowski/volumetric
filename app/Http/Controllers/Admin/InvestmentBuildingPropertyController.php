<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyFormRequest;
use App\Property;

use App\Investment;
use App\Building;
use App\Floor;

class InvestmentBuildingPropertyController extends Controller
{

    public function index(Floor $floor)
    {
        $properties = Property::where('floor_id', $floor->id)->get();
        $investment = Investment::find($floor->investment_id);

        return view('admin.investment_building_property.index', [
            'investment' => $investment,
            'building' => Building::find($floor->building_id),
            'floor' => $floor,
            'list' => $properties
        ]);
    }

    public function create(Floor $floor)
    {
        $investment = Investment::find($floor->investment_id);
        $building = Building::find($floor->building_id);

        return view('admin.investment_building_property.form', [
            'cardTitle' => 'Dodaj mieszkanie',
            'backButton' => route('admin.developro.building.property.index', [$investment, $building, $floor]),
            'floor' => $floor,
            'building' => $building,
            'investment' => $investment,
            'planwidth' => Property::PLAN_WIDTH,
            'planheight' => Property::PLAN_HEIGHT,
        ])->with('entry', Property::make());
    }

    public function store(PropertyFormRequest $request, Floor $floor)
    {
        $property = Property::create($request->merge([
            'investment_id' => $floor->investment_id,
            'building_id' => $floor->building_id,
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

        return redirect()->route('admin.developro.building.property.index', [$floor->investment_id, $floor->building_id, $floor->id])->with('success', 'Mieszkanie zapisane');
    }

    public function edit(Property $property)
    {

        $floor = Floor::where('id', $property->floor_id)->first();
        $investment = Investment::find($property->investment_id);
        $building = Building::find($property->building_id);

        return view('admin.investment_building_property.form', [
            'cardTitle' => 'Edytuj mieszkanie',
            'backButton' => route('admin.developro.building.property.index', [$investment, $building, $floor]),
            'floor' => $floor,
            'building' => $building,
            'investment' => $investment,
            'entry' => $property,
            'planwidth' => Property::PLAN_WIDTH,
            'planheight' => Property::PLAN_HEIGHT,
        ]);
    }

    public function update(PropertyFormRequest $request, Property $property)
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

        return redirect()->route('admin.developro.building.property.index',
            [
                $property->investment_id,
                $property->building_id,
                $property->floor_id
            ]
        )->with('success', 'Mieszkanie zapisane');
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return response()->json(['success' => 'Mieszkanie usnięte']);
    }
}
