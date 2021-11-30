<?php

namespace App\Http\Controllers\Admin\Developro;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

// CMS
use App\Http\Requests\BuildingFormRequest;
use App\Models\Investment;
use App\Models\Building;

class BuildingController extends Controller
{

    public function index(Investment $investment)
    {
        return view('admin.investment_building.index', ['investment' => $investment]);
    }

    public function create(Investment $investment)
    {
        return view('admin.investment_building.form', [
            'cardTitle' => 'Dodaj budynek',
            'backButton' => route('admin.developro.investment.building.index', $investment),
            'investment' => $investment,
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

        return redirect()->route('admin.developro.investment.building.index', $investment->id)->with('success', 'Budynek zapisany');
    }

    public function edit(Investment $investment, $id)
    {
        $building = Building::find($id);

        return view('admin.investment_building.form', [
            'cardTitle' => 'Edytuj budynek',
            'backButton' => route('admin.developro.investment.building.index', $investment),
            'investment' => $investment->load('plan'),
            'entry' => $building,
            'planwidth' => Building::PLAN_WIDTH,
            'planheight' => Building::PLAN_HEIGHT,
        ]);
    }

    public function update(BuildingFormRequest $request, Investment $investment, Building $building)
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

        return redirect()->route('admin.developro.investment.building.index', $investment)->with('success', 'Budynek zaktualizowany');
    }

    public function destroy($investment, $id)
    {
        $building = Building::find($id);
        $building->delete();
        Session::flash('success', 'Budynek usunięty');
        return response()->json('Deleted', 200);
    }
}
