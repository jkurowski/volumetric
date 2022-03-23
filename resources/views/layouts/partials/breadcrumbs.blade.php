<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/{{ $current_locale }}">@lang('cms.menu-homepage')</a></li>
        @foreach($items as $item)
        <li class="breadcrumb-item"><a href="/{{$item->uri}}">{{$item->title}}</a></li>
        @endforeach
        <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
    </ol>
</nav>

