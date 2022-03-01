<?php

namespace App\Http\Controllers\Admin\Map;

use App\Http\Controllers\Controller;

// CMS
use App\Http\Requests\MapFormRequest;
use App\Repositories\MapRepository;
use App\Models\Map;

class IndexController extends Controller
{
    private $repository;

    public function __construct(MapRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view('admin.map.index', ['list' => Map::orderBy('id', 'desc')->get()]);
    }

    public function create()
    {
        return view('admin.map.form', [
            'cardTitle' => 'Dodaj punkt na mapie',
            'backButton' => route('admin.map.index')
        ])->with('entry', Map::make());
    }

    public function store(MapFormRequest $request)
    {
        $this->repository->create($request->validated());
        return redirect(route('admin.map.index'))->with('success', 'Nowy punkt dodany');
    }

    public function edit(int $id)
    {
        return view('admin.map.form', [
            'entry' => Map::find($id),
            'cardTitle' => 'Edytuj punkt',
            'backButton' => route('admin.map.index')
        ]);
    }

    public function update(MapFormRequest $request, int $id)
    {
        $map = $this->repository->find($id);
        $this->repository->update($request->validated(), $map);
        return redirect(route('admin.map.index'))->with('success', 'Punkt zaktualizowany');
    }

    public function destroy(int $id)
    {
        $this->repository->delete($id);
        return response()->json('Deleted');
    }
}
