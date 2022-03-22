<?php

namespace App\Http\Controllers\Admin\Developro;

use App\Http\Controllers\Controller;

// CMS
use App\Http\Requests\InvestmentFormRequest;
use App\Models\Investment;
use App\Repositories\InvestmentRepository;
use App\Services\InvestmentService;

class IndexController extends Controller
{
    private $repository;
    private $service;

    public function __construct(InvestmentRepository $repository, InvestmentService $service)
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
        $this->service = $service;
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
        $investment = $this->repository->create($request->validated());

        if ($request->hasFile('file_thumb')) {
            $this->service->uploadThumb($request->name, $request->file('file_thumb'), $investment);
        }

        return redirect(route('admin.developro.index'))->with('success', 'Inwestycja zapisana');
    }

    public function edit(int $id)
    {

        if(request()->get('lang')) {
            app()->setLocale(request()->get('lang'));
        }

        return view('admin.investment.form', [
            'entry' => $this->repository->find($id),
            'cardTitle' => 'Edytuj inwestycję',
            'backButton' => route('admin.developro.index')
        ]);
    }

    public function update(InvestmentFormRequest $request, int $id)
    {

        if(request()->get('lang')) {
            app()->setLocale(request()->get('lang'));
        }

        $investment = $this->repository->find($id);
        $this->repository->update($request->validated(), $investment);

        if ($request->hasFile('file_thumb')) {
            $this->service->uploadThumb($request->name, $request->file('file_thumb'), $investment, true);
        }

        return redirect(route('admin.developro.index'))->with('success', 'Inwestycja zaktualizowana');
    }

    public function destroy(int $id)
    {
        $this->repository->delete($id);
        return response()->json('Deleted');
    }
}
