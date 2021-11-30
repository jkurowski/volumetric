<?php

namespace App\Http\Controllers\Admin\Developro;

use App\Http\Controllers\Controller;

// CMS
use App\Http\Requests\InvestmentFormRequest;
use App\Models\Investment;
use App\Repositories\InvestmentRepository;

class IndexController extends Controller
{
    private $repository;

    public function __construct(InvestmentRepository $repository)
    {
//        $this->middleware('permission:box-list|box-create|box-edit|box-delete', [
//            'only' => ['index','store']
//        ]);
//        $this->middleware('permission:box-create', [
//            'only' => ['create','store']
//        ]);
//        $this->middleware('permission:box-edit', [
//            'only' => ['edit','update']
//        ]);
//        $this->middleware('permission:box-delete', [
//            'only' => ['destroy']
//        ]);

        $this->repository = $repository;
    }

    public function index()
    {
        return view('admin.investment.index', ['list' => $this->repository->all()]);
    }

    public function create()
    {
        return view('admin.investment.form', [
            'cardTitle' => 'Dodaj inwestycje',
            'backButton' => route('admin.developro.index')
        ])->with('entry', Investment::make());
    }

    public function store(InvestmentFormRequest $request)
    {
        $this->repository->create($request->validated());
        return redirect(route('admin.developro.index'))->with('success', 'Inwestycja zapisana');
    }

    public function edit(int $id)
    {
        return view('admin.investment.form', [
            'entry' => $this->repository->find($id),
            'cardTitle' => 'Edytuj inwestycję',
            'backButton' => route('admin.developro.index')
        ]);
    }

    public function update(InvestmentFormRequest $request, int $id)
    {
        $investment = $this->repository->find($id);
        $this->repository->update($request->validated(), $investment);
        return redirect(route('admin.developro.index'))->with('success', 'Inwestycja zaktualizowana');
    }

    public function destroy(int $id)
    {
        $this->repository->delete($id);
        return response()->json('Deleted');
    }
}
