@extends('layouts.page')

@section('meta_title', $article->title)
@section('seo_title', $article->meta_title)
@section('seo_description', $article->meta_description)
@section('seo_robots', $article->meta_robots)
@section('schema')

    <!-- Schema.org -->
    {!! $schema->toScript() !!}
@stop

@section('pagheader')
    <div id="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Aktualności</h1>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container post-container">
        <div class="row">
            <div class="col-12">
                <h1>{{ $article->title }}</a></h1>
                <div class="post-entry"><p><b>{{$article->content_entry}}</b></p></div>
                <img src="/uploads/articles/{!! $article->file !!}" alt="{{ $article->title }}" class="mb-5">
                <div class="post-text pb-5">
                    <p>{!! $article->content !!}</p>
                </div>
                <a href="{{route('front.news.index')}}" class="bttn bttn-right"><i class="las la-arrow-left"></i> Wróć do listy</a>
            </div>
        </div>
    </div>
@endsection
