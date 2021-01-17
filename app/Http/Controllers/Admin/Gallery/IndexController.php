<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryFormRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Gallery;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.gallery.index', ['list'=>Gallery::all()->sortBy('sort')]);
    }

    public function ajaxGetGalleries()
    {
        return Gallery::all('id','name')->toJson();
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
        Gallery::create($request->except(['_token', 'submit']));
        return redirect(route('admin.gallery.index'))->with('success', 'Nowa galeria dodana');
    }

    public function show($id)
    {
        return view('admin.gallery.show', ['gallery' => Gallery::with('photos')->find($id)]);
    }

    public function edit($id)
    {
        return view('admin.gallery.form', [
            'entry' => Gallery::find($id),
            'cardTitle' => 'Edytuj regułkę',
            'backButton' => route('admin.gallery.index')
        ]);
    }

    public function update(GalleryFormRequest $request, $id)
    {
        $gallery = Gallery::find($id);
        $gallery->update($request->except(['_token', 'submit']));
        return redirect(route('admin.gallery.index'))->with('success', 'Galeria zaktualizowana');
    }

    public function destroy($id)
    {
        Gallery::find($id)->delete();
        Session::flash('success', 'Galeria usunięta');
        return response()->json('Deleted', 200);
    }

    public function sort(Request $request, Gallery $gallery)
    {
        $gallery->sort($request);
    }
}
