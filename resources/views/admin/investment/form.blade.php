@extends('admin.layout')
@section('content')
@if(Route::is('admin.developro.edit'))
    <form method="POST" action="{{route('admin.developro.update', $entry->id)}}" enctype="multipart/form-data">
        @method('PUT')
@else
    <form method="POST" action="{{route('admin.developro.store')}}" enctype="multipart/form-data">
@endif
        @csrf
        <div class="container">
            <div class="card">
                <div class="card-head container">
                    <div class="row">
                        <div class="col-12 pl-0">
                            <h4 class="page-title row"><i class="fe-book-open"></i><a href="{{route('admin.developro.index')}}" class="p-0">Inwestycje</a><span class="d-inline-flex ml-2 mr-2">/</span>{{ $cardTitle }}</h4>
                        </div>
                    </div>
                </div>
                @include('form-elements.back-route-button')
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @include('form-elements.html-select', [
                                'label' => 'Typ inwestycji',
                                'name' => 'type',
                                'selected' => $entry->type,
                                'select' => [
                                    '1' => 'Inwestycja osiedlowa',
                                    '2' => 'Inwestycja budynkowa',
                                    '3' => 'Inwestycja z domami',
                                    '4' => 'Inwestycja etapowa'
                            ]])
                            @include('form-elements.html-select', [
                                'label' => 'Status inwestycji',
                                'name' => 'status',
                                'selected' => $entry->status,
                                'select' => [
                                    '1' => 'Inwestycja w sprzedaży',
                                    '2' => 'Inwestycja zakończona',
                                    '3' => 'Inwestycja planowana',
                                    '4' => 'Inwestycja ukryta'
                            ]])
                            @include('form-elements.html-input-text', ['label' => 'Nazwa inwestycji', 'name' => 'name', 'value' => $entry->name, 'required' => 1])
                            @include('form-elements.html-input-text', ['label' => 'Adres inwestycji', 'name' => 'address', 'value' => $entry->address])
                            @include('form-elements.html-input-text', ['label' => 'Miasto inwestycji', 'name' => 'city', 'value' => $entry->city])
                            @include('form-elements.html-input-text', ['label' => 'Termin rozpoczęcia inwestycji', 'name' => 'date_start', 'value' => $entry->date_start])
                            @include('form-elements.html-input-text', ['label' => 'Termin zakończenia inwestycji', 'name' => 'date_end', 'value' => $entry->date_end])
                            @include('form-elements.html-input-text', ['label' => 'Ilość lokali', 'name' => 'areas_amount', 'value' => $entry->areas_amount])
                            @include('form-elements.input-text', ['label' => 'Zakres powierzchni w wyszukiwarce xx-xx', 'sublabel' => '(zakresy oddzielone przecinkiem)', 'name' => 'area_range', 'value' => $entry->area_range])
                            @include('form-elements.html-input-text', ['label' => 'Adres biura sprzedaży', 'name' => 'office_address', 'value' => $entry->office_address])
                            @include('form-elements.html-input-text-count', ['label' => 'Nagłówek strony', 'sublabel'=> 'Meta tag - title', 'name' => 'meta_title', 'value' => $entry->meta_title, 'maxlength' => 60])
                            @include('form-elements.html-input-text-count', ['label' => 'Opis strony', 'sublabel'=> 'Meta tag - description', 'name' => 'meta_description', 'value' => $entry->meta_description, 'maxlength' => 158])
                            @include('form-elements.html-input-text', ['label' => 'Indeksowanie', 'sublabel'=> 'Meta tag - robots', 'name' => 'meta_robots', 'value' => $entry->meta_robots])
                            @include('form-elements.html-input-text', ['label' => 'Krótki opis na liście', 'name' => 'entry_content', 'value' => $entry->entry_content])
                            @include('form-elements.html-input-file', ['label' => 'Miniaturka', 'sublabel' => '(wymiary: '.config('images.investment_thumb.width').'px / '.config('images.investment_thumb.height').'px)', 'name' => 'file'])
                            @include('form-elements.textarea-fullwidth', ['label' => 'Opis inwestycji', 'name' => 'content', 'value' => $entry->content, 'rows' => 11, 'class' => 'tinymce', 'required' => 1])
                            @include('form-elements.textarea-fullwidth', ['label' => 'Opis inwestycji po zakończeniu', 'name' => 'end_content', 'value' => $entry->end_content, 'rows' => 11, 'class' => 'tinymce'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
    </form>
    @include('form-elements.tintmce')
@endsection
