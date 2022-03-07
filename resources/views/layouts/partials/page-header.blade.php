<div id="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-header-content">
                    <div>
                        <div class="section-header text-center">
                            <span>@include('layouts.partials.breadcrumbs', ['items' => $page->ancestors, 'title' => ($page->content_header) ?: $page->title])</span>
                            <h1>{{($page->page_title) ? : $page->title}}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
