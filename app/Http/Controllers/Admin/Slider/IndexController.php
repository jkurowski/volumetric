<?php

namespace App\Http\Controllers\Admin\Slider;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderFormRequest;
use Illuminate\Http\Request;

use App\Models\Slider;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    function __construct(){
        $this->middleware('permission:slider-list|slider-create|slider-edit|slider-delete', ['only' => ['index','store']]);
        $this->middleware('permission:slider-create', ['only' => ['create','store']]);
        $this->middleware('permission:slider-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:slider-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('admin.slider.index', ['list' => Slider::all()->sortBy("sort")]);
    }

    public function create()
    {
        return view('admin.slider.form',
            [
                'cardTitle' => 'Dodaj obrazek',
                'backButton' => route('admin.slider.index')
            ])
            ->with('entry', Slider::make());
    }

    public function store(SliderFormRequest $request)
    {
        $slider = Slider::create($request->only(['title', 'link', 'link_button']));

        if ($request->hasFile('file')) {
            $slider->upload($request->title, $request->file('file'));
        }

        return redirect(route('admin.slider.index'))->with('success', 'Nowy obrazek dodany');
    }

    public function edit($id)
    {
        return view('admin.slider.form', [
            'entry' => Slider::find($id),
            'cardTitle' => 'Edytuj obrazek',
            'backButton' => route('admin.slider.index')
        ]);
    }

    public function update(SliderFormRequest $request, Slider $slider)
    {
        $slider->update($request->only(['title', 'link', 'link_button']));

        if ($request->hasFile('file')) {
            $slider->upload($request->title, $request->file('file'), true);
        }

        return redirect(route('admin.slider.index'))->with('success', 'Obrazek zaktualizowany');
    }

    public function destroy($id)
    {
        Slider::find($id)->delete();
        Session::flash('success', 'Obrazek usunięty');
        return response()->json('Deleted', 200);
    }

    public function sort(Request $request, Slider $slider)
    {
        $slider->sort($request);
    }
}
