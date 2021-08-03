@extends('admin.layout')

@section('content')
    @if(Route::is('admin.page.edit'))
        <form method="POST" action="{{route('admin.page.update', $entry->id)}}" enctype="multipart/form-data">
        @method('PUT')
    @else
        <form method="POST" action="{{route('admin.page.store')}}" enctype="multipart/form-data">
    @endif
    @csrf
        <div class="container">
            <div class="card">
                @include('form-elements.card-header')
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @include('form-elements.status', ['label' => 'Status', 'name' => 'menu', 'selected' => $entry->menu, 'options' => ['1' => 'Pokaż na liście']])
                            @include('form-elements.page-select', [
                                'label' => 'Podstrona',
                                'name' => 'parent_id',
                                'selected' => $entry->parent_id,
                                'options' => $selectMenu
                            ])
                            @include('form-elements.input-text', ['label' => 'Tytuł strony', 'name' => 'title', 'value' => $entry->title, 'required' => 1])
                            @include('form-elements.input-text', ['label' => 'Nagłówek H1', 'name' => 'content_header', 'value' => $entry->content_header])
                            @include('form-elements.input-text', ['label' => 'Nagłówek strony', 'sublabel'=> 'Meta tag - title', 'name' => 'meta_title', 'value' => $entry->meta_title])
                            @include('form-elements.input-text', ['label' => 'Opis strony', 'sublabel'=> 'Meta tag - description', 'name' => 'meta_description', 'value' => $entry->meta_description])
                            @include('form-elements.input-text', ['label' => 'Indeksowanie', 'sublabel'=> 'Meta tag - robots', 'name' => 'meta_robots', 'value' => $entry->meta_robots])
                            @include('form-elements.textarea', ['label' => 'Wprowadź tekst', 'name' => 'content', 'value' => $entry->content, 'rows' => 11, 'class' => 'tinymce', 'required' => 1])
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
        </form>
        @include('form-elements.tintmce')
@endsection
