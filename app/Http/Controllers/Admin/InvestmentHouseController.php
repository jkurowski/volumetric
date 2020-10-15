<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyFormRequest;
use Illuminate\Support\Facades\Session;

use App\Investment;
use App\Property;

class InvestmentHouseController extends Controller
{
    public function index(Investment $investment)
    {
        return view('admin.investment_house.index', ['investment' => $investment]);
    }

    public function create(Investment $investment)
    {
        return view('admin.investment_house.form', [
            'cardTitle' => 'Dodaj dom',
            'backButton' => route('admin.developro.investment.house.index', $investment),
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

        return redirect()->route('admin.developro.investment.house.index', [$investment->id])->with('success', 'Dom poprawnie zapisany');
    }

    public function edit(Investment $investment, $id)
    {
        return view('admin.investment_house.form', [
            'cardTitle' => 'Edytuj dom',
            'backButton' => route('admin.developro.investment.house.index', $investment),
            'investment' => $investment,
            'entry' => Property::find($id),
            'planwidth' => Property::PLAN_WIDTH,
            'planheight' => Property::PLAN_HEIGHT,
        ]);
    }

    public function update(PropertyFormRequest $request, Investment $investment, $id)
    {
        $property = Property::find($id);

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

        return redirect()->route('admin.developro.investment.house.index', $investment->id)->with('success', 'Dom zaktualizowany');
    }

    public function destroy($investment, $id)
    {
        $property = Property::find($id);
        $property->delete();
        Session::flash('success', 'Dom usnięty');
        return response()->json('Deleted', 200);
    }
}
