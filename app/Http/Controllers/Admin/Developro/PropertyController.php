<?php

namespace App\Http\Controllers\Admin\Developro;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyFormRequest;
use Illuminate\Support\Facades\Session;

use App\Investment;
use App\Floor;
use App\Property;


class PropertyController extends Controller
{
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

    public function create(Investment $investment, Floor $floor)
    {
        return view('admin.investment_property.form', [
            'cardTitle' => 'Dodaj powierzchnię',
            'backButton' => route('admin.developro.investment.floor.property.index', [$investment, $floor]),
            'floor' => $floor,
            'investment' => $investment,
            'planwidth' => Property::PLAN_WIDTH,
            'planheight' => Property::PLAN_HEIGHT,
        ])->with('entry', Property::make());
    }

    public function store(PropertyFormRequest $request, Investment $investment, Floor $floor)
    {
        $property = Property::create($request->merge([
            'investment_id' => $investment->id,
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

        return redirect()->route('admin.developro.investment.floor.property.index', [$investment, $floor])->with('success', 'Powierzchnia zapisana');
    }

    public function edit(Investment $investment, Floor $floor, $id)
    {
        $property = Property::find($id);

        return view('admin.investment_property.form', [
            'cardTitle' => 'Edytuj powierzchnię',
            'backButton' => route('admin.developro.investment.floor.property.index', [$investment, $floor]),
            'floor' => $floor,
            'investment' => $investment,
            'entry' => $property,
            'planwidth' => Property::PLAN_WIDTH,
            'planheight' => Property::PLAN_HEIGHT,
        ]);
    }

    public function update(PropertyFormRequest $request, Investment $investment, Floor $floor, Property $property)
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

        return redirect()->route('admin.developro.investment.floor.property.index', [$investment, $floor])->with('success', 'Powierzchnia zaktualizowana');
    }

    public function destroy($investment, $floor, $id)
    {
        $property = Property::find($id);
        $property->delete();
        Session::flash('success', 'Powierzchnia usunięta');
        return response()->json('Deleted', 200);
    }
}
