<?php

namespace App\Http\Controllers\Admin;

use App\Building;
use App\Http\Controllers\Controller;
use App\Http\Requests\BuildingFormRequest;
use App\Investment;

class InvestmentBuildingController extends Controller
{

    public function index(Investment $investment)
    {
        return view('admin.investment_building.index', ['investment' => $investment]);
    }

    public function create(Investment $investment)
    {
        return view('admin.investment_building.form', [
            'cardTitle' => 'Dodaj budynek',
            'backButton' => route('admin.developro.building.index', $investment),
            'investment' => $investment,
            'planwidth' => Building::PLAN_WIDTH,
            'planheight' => Building::PLAN_HEIGHT,
        ])->with('entry', Building::make());
    }

    public function store(BuildingFormRequest $request, Investment $investment)
    {
        $building = Building::create($request->merge([
            'investment_id' => $investment->id
        ])->only([
            'investment_id',
            'name',
            'number',
            'cords',
            'html'
        ]));

        if ($request->hasFile('file')) {
            $building->planUpload($request->name, $request->file('file'));
        }

        return redirect()->route('admin.developro.building.index', $investment->id)->with('success', 'Budynek zapisany');
    }

    public function edit($id)
    {
        $building = Building::where('id', $id)->first();
        $investment = Investment::find($building->investment_id)->load('plan');

        return view('admin.investment_building.form', [
            'cardTitle' => 'Edytuj budynek',
            'backButton' => route('admin.developro.building.index', $investment),
            'investment' => $investment,
            'entry' => $building,
            'planwidth' => Building::PLAN_WIDTH,
            'planheight' => Building::PLAN_HEIGHT,
        ]);
    }

    public function update(BuildingFormRequest $request, Building $building)
    {
        $building->update($request->only([
            'name',
            'number',
            'cords',
            'html'
        ]));

        if ($request->hasFile('file')) {
            $building->planUpload($request->name, $request->file('file'), true);
        }

        return redirect()->route('admin.developro.building.index', $building->investment_id)->with('success', 'Budynek zaktualizowane');
    }

    public function destroy(Building $building)
    {
        $building->delete();
        return response()->json(['success' => 'Budynek usnięty']);
    }
}
