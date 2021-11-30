@extends('layouts.page')

@section('meta_title', $article->title)
@section('seo_title', $article->meta_title)
@section('seo_description', $article->meta_description)
@section('seo_robots', $article->meta_robots)
@section('schema')
<!-- Schema.org -->
{!! $schema->toScript() !!}
@stop
@section('opengraph')
<!-- Open Graph -->
{!! $opengraph->renderTags() !!}
@stop
@section('pageheader')
    @include('layouts.partials.page-header', ['page' => $page])
@stop

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-11">
                <img src="/uploads/articles/{!! $article->file !!}" alt="{{ $article->title }}">
                <div class="post-details-entry mt-5">
                    <h1 class="post-details-title">{{ $article->title }}</a></h1>
                    <p><b>{{$article->content_entry}}</b></p>
                </div>
                <div class="post-details-text pb-5">
                    <p>{!! $article->content !!}</p>
                </div>
                <a href="{{route('front.news.index')}}" class="bttn bttn-sm">Wróć do listy</a>
            </div>
        </div>
    </div>
@endsection
