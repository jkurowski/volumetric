<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleFormRequest;
use Illuminate\Support\Facades\Session;

use App\Article;

class IndexController extends Controller
{

    public function index()
    {
        return view('admin.article.index', ['list' => Article::orderBy('sort', 'asc')->get()]);
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

        $article = Article::create($request->except(['_token', 'submit']));

        if ($request->hasFile('file')) {
            $article->upload($request->slug, $request->file('file'));
        }

        if ($request->hasFile('file_header')) {
            $article->header($request->slug, $request->file('file_header'));
        }

        return redirect(route('admin.article.index'))->with('success', 'Nowy artykuł dodany');
    }

    public function edit($id)
    {
        return view('admin.article.form', [
            'entry' => Article::find($id),
            'cardTitle' => 'Edytuj artykuł',
            'backButton' => route('admin.article.index')
        ]);
    }

    public function update(ArticleFormRequest $request, Article $article)
    {

        $article->update($request->except(['_token', 'submit']));

        if ($request->hasFile('file')) {
            $article->upload($request->slug, $request->file('file'), true);
        }

        if ($request->hasFile('file_header')) {
            $article->header($request->slug, $request->file('file_header'), true);
        }

        return redirect(route('admin.article.index'))->with('success', 'Artykuł zaktualizowany');
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        Session::flash('success', 'Artykuł usunięty');
        return response()->json('Deleted', 200);
    }
}
