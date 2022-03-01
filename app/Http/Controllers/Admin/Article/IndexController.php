<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;

// CMS
use App\Http\Requests\ArticleFormRequest;
use App\Repositories\ArticleRepository;
use App\Services\ArticleService;
use App\Models\Article;

class IndexController extends Controller
{
    private $repository;
    private $service;

    public function __construct(ArticleRepository $repository, ArticleService $service)
    {
        $this->middleware('permission:article-list|box-create|box-edit|box-delete', [
            'only' => ['index','store']
        ]);
        $this->middleware('permission:article-create', [
            'only' => ['create','store']
        ]);
        $this->middleware('permission:article-edit', [
            'only' => ['edit','update']
        ]);
        $this->middleware('permission:article-delete', [
            'only' => ['destroy']
        ]);

        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        return view('admin.article.index', ['list' => $this->repository->allSort('ASC')]);
    }

    public function create()
    {
        return view('admin.article.form', [
            'cardTitle' => 'Dodaj artykuł',
            'backButton' => route('admin.article.index')
        ])->with('entry', Article::make());
    }

    public function store(ArticleFormRequest $request)
    {

        $article = $this->repository->create($request->validated());

        if ($request->hasFile('file')) {
            $this->service->upload($request->title, $request->file('file'), $article);
        }

        if ($request->hasFile('file_facebook')) {
            $this->service->uploadFileFacebook($request->title, $request->file('file_facebook'), $article);
        }

        return redirect(route('admin.article.index'))->with('success', 'Nowy artykuł dodany');
    }

    public function edit(int $id)
    {
        return view('admin.article.form', [
            'entry' => Article::find($id),
            'cardTitle' => 'Edytuj artykuł',
            'backButton' => route('admin.article.index')
        ]);
    }

    public function update(ArticleFormRequest $request, int $id)
    {

        $article = $this->repository->find($id);
        $this->repository->update($request->validated(), $article);

        if ($request->hasFile('file')) {
            $this->service->upload($request->title, $request->file('file'), $article, true);
        }

        if ($request->hasFile('file_facebook')) {
            $this->service->uploadFileFacebook($request->title, $request->file('file_facebook'), $article, true);
        }

        return redirect(route('admin.article.index'))->with('success', 'Artykuł zaktualizowany');
    }

    public function destroy(int $id)
    {
        $this->repository->delete($id);
        return response()->json('Deleted');
    }
}
