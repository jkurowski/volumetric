<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FloorFormRequest;
use App\Investment;
use App\Floor;

class InvestmentFloorController extends Controller
{
    protected $redirectTo = 'admin/developro/floors/';

    public function index(Investment $investment)
    {
        return view('admin.investment_floor.index', ['investment' => $investment, 'list' => $investment->floors]);
    }

    public function create(Investment $investment)
    {
        $investment->load('plan');
        return view('admin.investment_floor.form', [
            'cardTitle' => 'Dodaj pietro',
            'backButton' => $this->redirectTo.$investment->id,
            'planwidth' => Floor::PLAN_WIDTH,
            'planheight' => Floor::PLAN_HEIGHT,
            'investment' => $investment,
        ])->with('entry', Floor::make());
    }

    public function store(FloorFormRequest $request, Investment $investment)
    {
        $floor = Floor::create($request->merge([
            'investment_id' => $investment->id
        ])->only([
            'investment_id',
            'type',
            'name',
            'cords',
            'html'
        ]));

        if ($request->hasFile('file')) {
            $floor->planUpload($request->name, $request->file('file'));
        }

        return redirect()->route('admin.developro.floor.index', $investment->id)->with('success', 'Nowe piętro dodane');
    }

    public function edit($id)
    {
        $floor = Floor::where('id', $id)->first();
        $investment = Investment::where('id', $floor->investment_id)->first();

        return view('admin.investment_floor.form', [
            'cardTitle' => 'Edytuj pietro',
            'backButton' => $this->redirectTo.$investment->id,
            'planwidth' => Floor::PLAN_WIDTH,
            'planheight' => Floor::PLAN_HEIGHT,
            'entry' => $floor,
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

        return redirect()->route('admin.developro.floor.index', $floor->investment_id)->with('success', 'Pietro zaktualizowane');
    }

    public function destroy(Floor $floor)
    {
        $floor->delete();
        return response()->json(['success' => 'Piętro usniete']);
    }
}
