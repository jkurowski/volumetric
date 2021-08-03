<?php

namespace App\Http\Controllers\Admin\Url;

use App\Http\Controllers\Controller;
use App\Http\Requests\UrlFormRequest;
use App\Models\Url;
use App\Models\Page;

class IndexController extends Controller
{
    function __construct(){
        $this->middleware('permission:page-list|page-create|page-edit|page-delete', ['only' => ['index','store']]);
        $this->middleware('permission:page-create', ['only' => ['create','store']]);
        $this->middleware('permission:page-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:page-delete', ['only' => ['destroy']]);
    }

    protected $redirectTo = 'admin/page';

    public function create()
    {
        return view('admin.page.form_link', [
            'selectMenu' => Page::pluck('title', 'id'),
            'cardTitle' => 'Dodaj stronę',
            'backButton' => $this->redirectTo
        ])->with('entry', Url::make());
    }

    public function store(UrlFormRequest $request)
    {
        $page = Url::create($request->only(
            [
                'parent_id',
                'title',
                'url',
                'url_target',
                'meta_title',
                'meta_description',
                'meta_robots',
                'type',
                'menu'
            ]
        ));

        if ($request->parent_id) {

            $node = Url::find($request->parent_id);
            $node->appendNode($page);

        }

//        if ($request->hasFile('file')) {
//            $article->upload($request->slug, $request->file('file'));
//        }

        return redirect($this->redirectTo)->with('success', 'Link dodany');
    }

    public function edit(Page $url)
    {
        return view('admin.page.form_link', [
            'entry' => $url,
            'selectMenu' => Page::where('id', '!=', $url->id)->pluck('title', 'id'),
            'cardTitle' => 'Edytuj strone',
            'backButton' => $this->redirectTo
        ]);
    }

    public function update(UrlFormRequest $request, Url $url)
    {
        $url->update($request->only(
            [
                'parent_id',
                'title',
                'url',
                'url_target',
                'meta_title',
                'meta_description',
                'meta_robots',
                'menu'
            ]
        ));
//        if ($request->hasFile('file')) {
//            $article->upload($request->slug, $request->file('file'), true);
//        }

        return redirect($this->redirectTo)->with('success', 'Strona zaktualizowana');
    }
}
