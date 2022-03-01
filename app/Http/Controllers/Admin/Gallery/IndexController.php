<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// CMS
use App\Repositories\GalleryRepository;
use App\Http\Requests\GalleryFormRequest;
use App\Models\Gallery;

class IndexController extends Controller
{
    private $repository;

    public function __construct(GalleryRepository $repository)
    {
        $this->middleware('permission:gallery-list|gallery-create|gallery-edit|gallery-delete', [
            'only' => ['index','store']
        ]);
        $this->middleware('permission:gallery-create', [
            'only' => ['create','store']
        ]);
        $this->middleware('permission:gallery-edit', [
            'only' => ['edit','update']
        ]);
        $this->middleware('permission:gallery-delete', [
            'only' => ['destroy']
        ]);

        $this->repository = $repository;
    }

    public function index()
    {
        return view('admin.gallery.index', ['list' => $this->repository->allSort('ASC')]);
    }

    public function create()
    {
        return view('admin.gallery.form', [
            'cardTitle' => 'Dodaj galerię',
            'backButton' => route('admin.gallery.index')
        ])->with('entry', Gallery::make());
    }

    public function store(GalleryFormRequest $request)
    {
        $this->repository->create($request->validated());
        return redirect(route('admin.gallery.index'))->with('success', 'Nowa galeria dodana');
    }

    public function show(int $id)
    {
        return view('admin.gallery.show', ['gallery' => Gallery::with('photos')->find($id)]);
    }

    public function edit(int $id)
    {
        return view('admin.gallery.form', [
            'entry' => Gallery::find($id),
            'cardTitle' => 'Edytuj regułkę',
            'backButton' => route('admin.gallery.index')
        ]);
    }

    public function update(GalleryFormRequest $request, Gallery $gallery)
    {
        $this->repository->update($request->validated(), $gallery);
        return redirect(route('admin.gallery.index'))->with('success', 'Galeria zaktualizowana');
    }

    public function destroy(int $id)
    {
        $this->repository->delete($id);
        return response()->json('Deleted');
    }

    public function sort(Request $request)
    {
        $this->repository->updateOrder($request->get('recordsArray'));
    }
}
