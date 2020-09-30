@extends('layouts.page')

@section('meta_title', 'Aktualności')

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
<div id="news-list" class="container">
    <div class="row">
        @foreach ($articles as $n)
            <article class="col-12" id="list-post-{{ $n->id }}" itemscope="" itemtype="http://schema.org/NewsArticle">
                <div class="list-post">
                    <div class="row">
                        <div class="col-4">
                            <a href="{{route('front.news.show', $n->slug)}}" title="{{ $n->title }}" itemprop="url"><img src="{{asset('uploads/articles/thumbs/'.$n->file) }}" alt="{{ $n->title }}"></a>
                        </div>
                        <div class="col-8">
                            <div class="list-post-content">
                                <header>
                                    @if($n->date)<div class="list-post-date text-muted">Data publikacji: <span itemprop="datePublished" content="{{ $n->date }}">{{ $n->date }}</span></div>@endif
                                    <h2 class="list-post-title"><a href="{{route('front.news.show', $n->slug)}}" itemprop="url"><span itemprop="name headline">{{ $n->title }}</span></a></h2>
                                </header>

                                <div class="list-post-entry" itemprop="articleBody">
                                    <p class="text-muted">{{ $n->content_entry }}</p>
                                </div>

                                <footer>
                                    <a itemprop="url" href="{{route('front.news.show', $n->slug)}}" title="{{ $n->title }}" class="bttn mt-3">CZYTAJ WIĘCEJ <i class="las la-arrow-right"></i></a>
                                    <meta itemprop="author" content="DeveloPro">
                                    <meta itemprop="mainEntityOfPage" content="">
                                </footer>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</div>
@endsection
