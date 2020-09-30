<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyFormRequest;
use App\Investment;
use App\Property;
use Illuminate\Http\Request;

class InvestmentHouseController extends Controller
{
    protected $redirectTo = 'admin/developro/investment/';

    public function index(Investment $investment)
    {
        return view('admin.investment_house.index', ['investment' => $investment]);
    }

    public function create(Investment $investment)
    {
        return view('admin.investment_house.form', [
            'cardTitle' => 'Dodaj mieszkanie',
            'backButton' => route('admin.developro.house.index', $investment),
            'investment' => $investment,
            'planwidth' => Property::PLAN_WIDTH,
            'planheight' => Property::PLAN_HEIGHT,
        ])->with('entry', Property::make());
    }

    public function store(PropertyFormRequest $request, Investment $investment)
    {
        $property = Property::create($request->merge([
            'investment_id' => $investment->id
        ])->only([
            'investment_id',
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

        return redirect()->route('admin.developro.house.index', [$investment->id])->with('success', 'Domo zapisany');
    }

    public function edit($id)
    {
        $property = Property::where('id', $id)->first();
        $investment = Investment::find($property->investment_id)->load('plan');

        return view('admin.investment_house.form', [
            'cardTitle' => 'Edytuj mieszkanie',
            'backButton' => route('admin.developro.house.index', $investment),
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

        return redirect()->route('admin.developro.house.index', $property->investment_id)->with('success', 'Dom zaktualizowane');
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return response()->json(['success' => 'Dom usnięty']);
    }
}
