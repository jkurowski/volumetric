<?php

namespace App\Http\Controllers\Admin\Dictionary;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;

// CMS
use App\Http\Requests\DictionaryFormRequest;
use App\Services\DictionaryService;

class IndexController extends Controller
{
    private $service;

    public function __construct(DictionaryService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dictionary.index');
    }

    public function show($lang)
    {
        App::setLocale($lang);
        return view('admin.dictionary.show', ['locale' => $lang]);
    }

    public function edit($slug, $lang)
    {
        App::setLocale($lang);
        $entry = Lang::get('cms.'.$slug);

        return view('admin.dictionary.form', [
            'slug' => $slug,
            'entry' => $entry,
            'locale' => $lang,
            'cardTitle' => 'Edytuj wpis',
            'backButton' => route('admin.dictionary.show', $lang)
        ]);
    }

    public function store(DictionaryFormRequest $request)
    {
        $this->service->saveLangFile($request->dictionary_slug, $request->translation, $request->dictionary_locale);
        return redirect(route('admin.dictionary.show', $request->dictionary_locale))->with('success', 'Wpis zaktualizowany');
    }
}
