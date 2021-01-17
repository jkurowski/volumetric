<?php

namespace App\Http\Controllers\Admin\Map;

use App\Http\Controllers\Controller;
use App\Http\Requests\MapFormRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Map;

class IndexController extends Controller
{

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
        Map::create($request->except(['_token', 'submit']));
        return redirect(route('admin.map.index'))->with('success', 'Nowy punkt dodany');
    }

    public function edit($id)
    {
        return view('admin.map.form', [
            'entry' => Map::find($id),
            'cardTitle' => 'Edytuj punkt',
            'backButton' => route('admin.map.index')
        ]);
    }

    public function update(MapFormRequest $request, Map $map)
    {
        $map->update($request->except(['_token', 'submit']));
        return redirect(route('admin.map.index'))->with('success', 'Punkt zaktualizowany');
    }

    public function destroy($id)
    {
        $entry = Map::find($id);
        $entry->delete();
        Session::flash('success', 'Wpis usunięty');
        return response()->json('Deleted', 200);
    }
}
