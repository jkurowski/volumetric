@extends('layouts.page', ['body_class' => 'homepage'])

@section('meta_title', $page->title)
@section('seo_title', $page->meta_title)
@section('seo_description', $page->meta_description)
@section('seo_robots', $page->meta_robots)

@section('content')
    <div id="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>{{($page->content_header) ? $page->content_header : $page->title}}</h1>
                    @include('layouts.breadcrumbs', ['items' => $page->ancestors, 'title' => ($page->content_header) ? $page->content_header : $page->title])
                </div>
            </div>
        </div>
    </div>
    <div id="page-content">
        <div class="container">
            <div class="row">
                @if($parent && $parent->id)
                    <div class="col-4 pr-5">
                        {!! App\Models\Page::sidemenu($parent->id) !!}
                    </div>
                @endif

                <div @if($parent && $parent->id) class="col-8" @else class="col-12" @endif>
                    {!! parse_text($page->content) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
