@extends('admin.layout')
@section('content')
@if(Route::is('admin.article.edit'))
    <form method="POST" action="{{route('admin.article.update', $entry->id)}}" enctype="multipart/form-data">
    @method('PUT')
@else
    <form method="POST" action="{{route('admin.article.store')}}" enctype="multipart/form-data">
@endif
@csrf
<div class="container">
    <div class="card">
        <div class="card-head container">
            <div class="row">
                <div class="col-12 pl-0">
                    <h4 class="page-title row"><i class="fe-book-open"></i><a href="{{route('admin.article.index')}}">Aktualności</a><span class="d-inline-flex ml-2 mr-2">/</span>{{ $cardTitle }}</h4>
                </div>
            </div>
        </div>
        @include('form-elements.back-route-button')
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    @include('form-elements.select', ['label' => 'Status', 'name' => 'status', 'selected' => $entry->status, 'options' => ['1' => 'Pokaż na liście', '2' => 'Ukryj na liście']])
                    @include('form-elements.input-text', ['label' => 'Tytuł wpisu', 'name' => 'title', 'value' => $entry->title, 'required' => 1])
                    @include('form-elements.input-text', ['label' => 'Nagłówek strony', 'sublabel'=> 'Meta tag - title', 'name' => 'meta_title', 'value' => $entry->meta_title])
                    @include('form-elements.input-text', ['label' => 'Opis strony', 'sublabel'=> 'Meta tag - description', 'name' => 'meta_description', 'value' => $entry->meta_description])
                    @include('form-elements.input-text', ['label' => 'Indeksowanie', 'sublabel'=> 'Meta tag - robots', 'name' => 'meta_robots', 'value' => $entry->meta_robots])
                    @include('form-elements.input-file', ['label' => 'Zdjęcie', 'sublabel' => '(wymiary: '.\App\Article::IMG_WIDTH.'px / '.\App\Article::IMG_HEIGHT.'px)', 'name' => 'file'])
                    @include('form-elements.input-text', ['label' => 'Wprowadzenie', 'name' => 'content_entry', 'value' => $entry->content_entry, 'required' => 1])
                    @include('form-elements.textarea', ['label' => 'Treść artukułu', 'name' => 'content', 'value' => $entry->content, 'rows' => 11, 'class' => 'tinymce', 'required' => 1])
                </div>
            </div>
        </div>
    </div>
</div>
@if(Route::is('admin.article.edit'))
    <input type="hidden" name="article_id" value="{{$entry->id}}">
@endif
@include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
</form>
@include('form-elements.tintmce')
@endsection
