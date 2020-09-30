<ul class="mb-0 list-unstyled submenu">
    @foreach ($pages as $page)
    <li><a href="/{{$page->uri}}"@if($page->url_target) target="{{$page->url_target}}"@endif>{{$page->title}}</a>
    @if($page->children->count() > 0)
    @include('layouts.submenu', array('pages' => $page->children))
    @endif
    @endforeach</li>
</ul>

