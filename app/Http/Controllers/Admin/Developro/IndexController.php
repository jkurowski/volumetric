<?php

namespace App\Http\Controllers\Admin\Developro;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvestmentFormRequest;

use App\Models\Investment;

class IndexController extends Controller
{

    protected $redirectTo = 'admin/developro';

    public function index()
    {
        return view('admin.investment.index', ['list' => Investment::all()]);
    }

    public function create()
    {
        return view('admin.investment.form', [
            'cardTitle' => 'Dodaj inwestycje',
            'backButton' => $this->redirectTo
        ])->with('entry', Investment::make());
    }

    public function store(InvestmentFormRequest $request)
    {
        Investment::create($request->only(
            [
                'name',
                'type',
                'status'
            ]
        ));
        return redirect($this->redirectTo)->with('success', 'Inwestycja zaktualizowana');
    }

    public function edit($id)
    {
        $investment = Investment::find($id);

        return view('admin.investment.form', [
            'entry' => $investment,
            'cardTitle' => 'Edytuj inwestycję',
            'backButton' => $this->redirectTo
        ]);
    }

    public function update(InvestmentFormRequest $request, Investment $investment)
    {
        $investment->update($request->only(
            [
                'name',
                'type',
                'status'
            ]
        ));
        return redirect($this->redirectTo)->with('success', 'Inwestycja zaktualizowana');
    }

    public function destroy(Investment $investment)
    {
        $investment->delete();
        return response()->json(['success' => 'Wpis usniety']);
    }
}
