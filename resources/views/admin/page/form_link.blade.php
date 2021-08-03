@extends('admin.layout')

@section('content')
    @if(Route::is('admin.url.edit'))
        <form method="POST" action="{{route('admin.url.update', $entry->id)}}">
            @method('PUT')
            @else
        <form method="POST" action="{{route('admin.url.store')}}">
            @endif
            @csrf
            <div class="container">
                <div class="card">
                    @include('form-elements.card-header')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @include('form-elements.status', ['label' => 'Status', 'name' => 'menu', 'selected' => $entry->menu, 'options' => ['1' => 'Pokaż na liście']])
                                @include('form-elements.target-select', ['label' => 'Okno docelowe', 'name' => 'url_target', 'selected' => $entry->url_target])
                                @include('form-elements.html-input-text', ['label' => 'Adres url', 'sublabel'=> 'Zew. linki, moduł strony', 'name' => 'url', 'value' => $entry->url])
                                @include('form-elements.page-select', [
                                    'label' => 'Podstrona',
                                    'name' => 'parent_id',
                                    'selected' => $entry->parent_id,
                                    'options' => $selectMenu
                                ])
                                @include('form-elements.html-input-text', ['label' => 'Tytuł strony', 'name' => 'title', 'value' => $entry->title, 'required' => 1])
                                @include('form-elements.html-input-text', ['label' => 'Nagłówek H1', 'name' => 'content_header', 'value' => $entry->content_header])
                                @include('form-elements.html-input-text', ['label' => 'Nagłówek strony', 'sublabel'=> 'Meta tag - title', 'name' => 'meta_title', 'value' => $entry->meta_title])
                                @include('form-elements.html-input-text', ['label' => 'Opis strony', 'sublabel'=> 'Meta tag - description', 'name' => 'meta_description', 'value' => $entry->meta_description])
                                @include('form-elements.html-input-text', ['label' => 'Indeksowanie', 'sublabel'=> 'Meta tag - robots', 'name' => 'meta_robots', 'value' => $entry->meta_robots])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
        </form>
@endsection
