<div id="page-header" style="background-image: url('http://layerdrops.com/kitecx/assets/images/backgrounds/page-header-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-header-content">
                    <div>
                        <h1>{{($page->page_title) ? : $page->title}}</h1>
                        @include('layouts.partials.breadcrumbs', ['items' => $page->ancestors, 'title' => ($page->content_header) ?: $page->title])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
