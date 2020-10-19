<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RodoRulesFormRequest;

use App\RodoRules;
use Illuminate\Support\Facades\Session;

class RodoRulesController extends Controller
{
    public function index()
    {
        return view('admin.rodo_rules.index', ['list' => RodoRules::all()]);
    }

    public function create()
    {
        return view('admin.rodo_rules.form', [
            'cardTitle' => 'Dodaj regułkę',
            'backButton' => route('admin.rodo.rules.index')
        ])->with('entry', RodoRules::make());
    }

    public function store(RodoRulesFormRequest $request)
    {
        RodoRules::create($request->except(['_token', 'submit']));
        return redirect(route('admin.rodo.rules.index'))->with('success', 'Nowa regułka dodana');
    }

    public function edit($id)
    {
        return view('admin.rodo_rules.form', [
            'entry' => RodoRules::find($id),
            'cardTitle' => 'Edytuj regułkę',
            'backButton' => route('admin.rodo.rules.index')
        ]);
    }

    public function update(RodoRulesFormRequest $request, $id)
    {
        $rodoRules = RodoRules::find($id);
        $rodoRules->update($request->except(['_token', 'submit']));
        return redirect(route('admin.rodo.rules.index'))->with('success', 'Regułka zaktualizowana');
    }

    public function destroy($id)
    {
        RodoRules::find($id)->delete();
        Session::flash('success', 'Regułka usunięta');
        return response()->json('Deleted', 200);
    }
}
