@extends('layouts.page')

@section('meta_title', 'Aktualności')

@section('pageheader')
    @include('layouts.partials.page-header', ['page' => $page])
@stop

@section('content')
    <div id="main-news">
        <div class="container">
            <div class="row">
                @foreach ($articles as $n)
                    <article class="col-4" id="list-post-{{ $n->id }}" itemscope="" itemtype="http://schema.org/NewsArticle">
                        <div class="list-post">
                            <div class="list-post-thumb">
                                <a href="{{route('front.news.show', $n->slug)}}" title="{{ $n->title }}" itemprop="url"><img src="{{asset('uploads/articles/thumbs/'.$n->file) }}" alt="{{ $n->title }}"></a>
                            </div>
                            <div class="list-post-content">
                                <header>
                                    @if($n->date)<div class="list-post-date text-muted">Data publikacji: <span itemprop="datePublished" content="{{ $n->date }}">{{ $n->date }}</span></div>@endif
                                    <h5 class="title"><a href="{{route('front.news.show', $n->slug)}}" itemprop="url"><span itemprop="name headline">{{ $n->title }}</span></a></h5>
                                </header>

                                <div class="list-post-entry" itemprop="articleBody">
                                    <p class="small-text">{{ $n->content_entry }}</p>
                                </div>

                                <footer>
                                    <a itemprop="url" href="{{route('front.news.show', $n->slug)}}" title="{{ $n->title }}" class="bttn bttn-sm">Czytaj więcej</a>
                                    <meta itemprop="author" content="DeveloPro">
                                    <meta itemprop="mainEntityOfPage" content="">
                                </footer>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
@endsection
