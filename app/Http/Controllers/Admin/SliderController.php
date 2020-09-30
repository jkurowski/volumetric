<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderFormRequest;
use App\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    protected $redirectTo = 'admin/slider';

    public function index()
    {
        return view('admin.slider.index', ['list' => Slider::all()->sortBy("sort")]);
    }

    public function create()
    {
        return view('admin.slider.form',
            [
                'cardTitle' => 'Dodaj obrazek',
                'backButton' => $this->redirectTo
            ])
            ->with('entry', Slider::make());
    }

    public function store(SliderFormRequest $request)
    {
        $slider = Slider::create($request->only(['title', 'link', 'link_button']));

        if ($request->hasFile('file')) {
            $slider->upload($request->title, $request->file('file'));
        }

        return redirect($this->redirectTo)->with('success', 'Nowy obrazek dodany');
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.form', [
            'entry' => $slider,
            'cardTitle' => 'Edytuj obrazek',
            'backButton' => $this->redirectTo
        ]);
    }

    public function update(SliderFormRequest $request, Slider $slider)
    {
        $slider->update($request->only(['title', 'link', 'link_button']));

        if ($request->hasFile('file')) {
            $slider->upload($request->title, $request->file('file'), true);
        }

        return redirect($this->redirectTo)->with('success', 'Obrazek zaktualizowany');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();
        return response()->json(['success' => 'Obrazek usniety']);
    }

    public function sort(Request $request, Slider $slider)
    {
        $slider->sort($request);
    }
}
