<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageFormRequest;
use App\Http\Requests\PageUpdateFormRequest;
use App\Models\Page;

class IndexController extends Controller
{

    protected $redirectTo = 'admin/page';

    public function index()
    {
        //Page::fixTree();
        $tree = Page::withDepth()->defaultOrder()->get()->toTree();

        return view('admin.page.index', ['list' => $tree]);
    }

    public function create()
    {
        return view('admin.page.form', [
            'selectMenu' => Page::pluck('title', 'id'),
            'cardTitle' => 'Dodaj stronę',
            'backButton' => $this->redirectTo
        ])->with('entry', Page::make());
    }

    public function store(PageFormRequest $request)
    {
        $page = Page::create($request->only(
            [
                'parent_id',
                'title',
                'slug',
                'url',
                'url_target',
                'content',
                'content_header',
                'meta_title',
                'meta_description',
                'meta_robots',
                'menu'
            ]
        ));

        if ($request->parent_id) {

            $node = Page::find($request->parent_id);
            $node->appendNode($page);

        }

        $page->uriGenerate($page);

//        if ($request->hasFile('file')) {
//            $article->upload($request->slug, $request->file('file'));
//        }

        return redirect($this->redirectTo)->with('success', 'Strona dodana');
    }

    public function edit(Page $page)
    {
        return view('admin.page.form', [
            'entry' => $page,
            'selectMenu' => Page::where('id', '!=', $page->id)->pluck('title', 'id'),
            'cardTitle' => 'Edytuj strone',
            'backButton' => $this->redirectTo
        ]);
    }

    public function update(PageUpdateFormRequest $request, Page $page)
    {
        $page->update($request->only(
            [
                'parent_id',
                'title',
                'slug',
                'url',
                'url_target',
                'content',
                'content_header',
                'meta_title',
                'meta_description',
                'meta_robots',
                'menu'
            ]
        ));

        if ($request->parent_id) {

            $node = Page::find($request->parent_id);
            $node->appendNode($page);

        }

        $page->uriGenerate($page);

//        if ($request->hasFile('file')) {
//            $article->upload($request->slug, $request->file('file'), true);
//        }

        return redirect($this->redirectTo)->with('success', 'Strona zaktualizowana');
    }

    public function up(Page $page)
    {
        $node = Page::findOrFail($page->id);
        $node->up();
        return redirect($this->redirectTo)->with('success', 'Strona zaktualizowana');
    }

    public function down(Page $page)
    {
        $node = Page::findOrFail($page->id);
        $node->down();
        return redirect($this->redirectTo)->with('success', 'Strona zaktualizowana');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return response()->json(['success' => 'Artykuł usniety']);
    }
}
