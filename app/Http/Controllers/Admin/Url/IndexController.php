<?php

namespace App\Http\Controllers\Admin\Url;

use App\Http\Controllers\Controller;

// CMS
use App\Http\Requests\UrlFormRequest;
use App\Models\Url;
use App\Models\Page;
use App\Repositories\UrlRepository;
use App\Services\PageService;

class IndexController extends Controller
{
    private $repository;
    private $service;

    public function __construct(UrlRepository $repository, PageService $service)
    {
//        $this->middleware('permission:page-list|page-create|page-edit|page-delete', ['only' => ['index','store']]);
//        $this->middleware('permission:page-create', ['only' => ['create','store']]);
//        $this->middleware('permission:page-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:page-delete', ['only' => ['destroy']]);

        $this->repository = $repository;
        $this->service = $service;
    }

    public function create()
    {
        return view('admin.page.form_link', [
            'selectMenu' => Page::pluck('title', 'id')->prepend('Brak podstrony', 0),
            'cardTitle' => 'Dodaj adres URL',
            'backButton' => route('admin.page.index')
        ])->with('entry', Url::make());
    }

    public function store(UrlFormRequest $request)
    {
        $entry = $this->repository->create($request->validated());

        if ($request->hasFile('file')) {
            $this->service->upload($request->title, $request->file('file'), $entry);
        }

        return redirect(route('admin.page.index'))->with('success', 'Link dodany');
    }

    public function edit(Url $url)
    {

        if(request()->get('lang')) {
            app()->setLocale(request()->get('lang'));
        }

        return view('admin.page.form_link', [
            'entry' => $url,
            'selectMenu' => Page::where('id', '!=', $url->id)->pluck('title', 'id')->prepend('Brak podstrony', 0),
            'cardTitle' => 'Edytuj adres URL',
            'backButton' => route('admin.page.index')
        ]);
    }

    public function update(UrlFormRequest $request, int $id)
    {

        if(request()->get('lang')) {
            app()->setLocale(request()->get('lang'));
        }

        $page = $this->repository->find($id);

        if ($request->hasFile('file')) {
            $this->service->upload($request->title, $request->file('file'), $page, 1);
        }

        $this->repository->update($request->validated(), $page);

        return redirect(route('admin.page.index'))->with('success', 'Link zaktualizowany');
    }
}
