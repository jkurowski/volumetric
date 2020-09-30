<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleFormRequest;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $redirectTo = 'admin/article';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.article.index', ['list' => Article::orderBy('sort', 'asc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.article.form', [
            'cardTitle' => 'Dodaj artykuł',
            'backButton' => $this->redirectTo
        ])->with('entry', Article::make());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ArticleFormRequest $request)
    {

        $article = Article::create($request->only(
            [
                'category_id',
                'status',
                'title',
                'slug',
                'meta_title',
                'meta_description',
                'content_entry',
                'content'
            ]
        ));

        if ($request->hasFile('file')) {
            $article->upload($request->slug, $request->file('file'));
        }

        if ($request->hasFile('file_header')) {
            $article->header($request->slug, $request->file('file_header'));
        }

        return redirect($this->redirectTo)->with('success', 'Nowy artykuł dodany');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $article = Article::where('id', $id)->first();
        return view('admin.article.form', [
            'entry' => $article,
            'cardTitle' => 'Edytuj artykuł',
            'backButton' => $this->redirectTo
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ArticleFormRequest $request, Article $article)
    {

        $article->update($request->only(
            [
                'category_id',
                'status',
                'title',
                'slug',
                'meta_title',
                'meta_description',
                'content_entry',
                'content'
            ]
        ));

        if ($request->hasFile('file')) {
            $article->upload($request->slug, $request->file('file'), true);
        }

        if ($request->hasFile('file_header')) {
            $article->header($request->slug, $request->file('file_header'), true);
        }

        return redirect($this->redirectTo)->with('success', 'Artykuł zaktualizowany');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Article $article)
    {
        unlink(public_path('uploads/articles/' . $article->file));
        unlink(public_path('uploads/articles/thumbs/' . $article->file));
        unlink(public_path('uploads/articles/header/' . $article->file));

        $article->delete();
        return response()->json(['success' => 'Artykuł usniety']);
    }
}
