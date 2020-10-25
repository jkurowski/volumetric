<?php

namespace App\Http\Controllers\Admin\Developro;

use App\Http\Controllers\Controller;
use App\Http\Requests\FloorFormRequest;
use Illuminate\Support\Facades\Session;

use App\Investment;
use App\Floor;

class FloorController extends Controller
{
    public function index(Investment $investment)
    {
        return view('admin.investment_floor.index', ['investment' => $investment, 'list' => $investment->floors]);
    }

    public function create(Investment $investment)
    {
        $investment->load('plan');
        return view('admin.investment_floor.form', [
            'cardTitle' => 'Dodaj pietro',
            'backButton' => route('admin.developro.investment.floor.index', $investment),
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

        return redirect()->route('admin.developro.investment.floor.index', $investment)->with('success', 'Nowe piętro dodane');
    }

    public function edit(Investment $investment, $id)
    {
        return view('admin.investment_floor.form', [
            'cardTitle' => 'Edytuj pietro',
            'backButton' => route('admin.developro.investment.floor.index', $investment),
            'planwidth' => Floor::PLAN_WIDTH,
            'planheight' => Floor::PLAN_HEIGHT,
            'entry' => Floor::find($id),
            'investment' => $investment
        ]);
    }

    public function update(FloorFormRequest $request, Investment $investment, $id)
    {
        $floor = Floor::find($id);
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

        return redirect()->route('admin.developro.investment.floor.index', $investment)->with('success', 'Pietro zaktualizowane');
    }

    public function destroy($investment, $id)
    {
        $floor = Floor::find($id);
        $floor->delete();
        Session::flash('success', 'Piętro usunięte');
        return response()->json('Deleted', 200);
    }
}
