<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyFormRequest;
use App\Investment;
use App\Floor;

use App\Property;
use Illuminate\Http\Request;

class InvestmentPropertyController extends Controller
{
    protected $redirectTo = 'admin/developro/investment/';

    public function index(Investment $investment, Floor $floor)
    {
        $list = $investment->load(array(
            'floorRooms' => function($query) use ($floor)
            {
                $query->where('floor_id', $floor->id);
            }
        ));

        return view('admin.investment_property.index', [
            'investment' => $investment,
            'floor' => $floor,
            'list' => $list
        ]);
    }

    public function create(Floor $floor)
    {

        $investment = Investment::find($floor->investment_id);

        return view('admin.investment_property.form', [
            'cardTitle' => 'Dodaj mieszkanie',
            'backButton' => $this->redirectTo.$floor->investment_id,
            'floor' => $floor,
            'investment' => $investment,
            'planwidth' => Property::PLAN_WIDTH,
            'planheight' => Property::PLAN_HEIGHT,
        ])->with('entry', Property::make());
    }

    public function store(PropertyFormRequest $request, Floor $floor)
    {
        $property = Property::create($request->merge([
            'investment_id' => $floor->investment_id,
            'floor_id' => $floor->id
        ])->only([
            'investment_id',
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

        return redirect()->route('admin.developro.property.index', [$floor->investment_id, $floor->id])->with('success', 'Mieszkanie zapisane');
    }

    public function edit($id)
    {
        $property = Property::where('id', $id)->first();
        $floor = Floor::where('id', $property->floor_id)->first();
        $investment = Investment::find($property->investment_id);

        return view('admin.investment_property.form', [
            'cardTitle' => 'Edytuj mieszkanie',
            'backButton' => $this->redirectTo.$property->investment_id,
            'floor' => $floor,
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

        return redirect()->route('admin.developro.property.index', [$property->investment_id, $property->floor_id])->with('success', 'Mieszkanie zaktualizowane');
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return response()->json(['success' => 'Mieszkanie usnięte']);
    }
}
