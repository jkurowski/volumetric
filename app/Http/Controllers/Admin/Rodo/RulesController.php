<?php

namespace App\Http\Controllers\Admin\Rodo;

use App\Http\Controllers\Controller;

// CMS
use App\Models\RodoRules;
use App\Http\Requests\RodoRulesFormRequest;
use App\Repositories\RodoRuleRepository;

class RulesController extends Controller
{
    private $repository;

    public function __construct(RodoRuleRepository $repository)
    {
        $this->repository = $repository;
    }

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
        $this->repository->create($request->validated());
        return redirect(route('admin.rodo.rules.index'))->with('success', 'Nowa regułka dodana');
    }

    public function edit(int $id)
    {
        if(request()->get('lang')) {
            app()->setLocale(request()->get('lang'));
        }

        return view('admin.rodo_rules.form', [
            'entry' => RodoRules::find($id),
            'cardTitle' => 'Edytuj regułkę',
            'backButton' => route('admin.rodo.rules.index')
        ]);
    }

    public function update(RodoRulesFormRequest $request, RodoRules $rule)
    {
        if(request()->get('lang')) {
            app()->setLocale(request()->get('lang'));
        }

        $this->repository->update($request->validated(), $rule);

        return redirect(route('admin.rodo.rules.index'))->with('success', 'Regułka zaktualizowana');
    }

    public function destroy(int $id)
    {
        $this->repository->delete($id);
        return response()->json('Deleted');
    }
}
