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
                            <h4 class="page-title"><i class="fe-book-open"></i><a href="{{route('admin.developro.index')}}" class="p-0">Inwestycje</a><span class="d-inline-flex me-2 ms-2">/</span>{{ $cardTitle }}</h4>
                        </div>
                    </div>
                </div>
                @include('form-elements.back-route-button')
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @include('form-elements.html-select', [
                                'label' => 'Status inwestycji',
                                'name' => 'status',
                                'selected' => $entry->status,
                                'select' => [
                                    '1' => 'Inwestycja w sprzedaży',
                                    '3' => 'Inwestycja planowana'
                            ]])
                            @include('form-elements.html-input-text', ['label' => 'Nazwa inwestycji', 'name' => 'name', 'value' => $entry->name, 'required' => 1])
                            @include('form-elements.html-input-text', ['label' => 'Adres inwestycji', 'name' => 'address', 'value' => $entry->address, 'required' => 1])
                            @include('form-elements.html-input-text', ['label' => 'Miasto inwestycji', 'name' => 'city', 'value' => $entry->city, 'required' => 1])
                            @include('form-elements.html-input-text', ['label' => 'Strona inwestycji', 'name' => 'url', 'value' => $entry->url, 'required' => 1])
                            @include('form-elements.html-input-text', ['label' => 'Krótki opis na liście', 'name' => 'entry_content', 'value' => $entry->entry_content])
                            @include('form-elements.html-input-file', ['label' => 'Miniaturka', 'sublabel' => '(wymiary: '.config('images.investment.thumb_width').'px / '.config('images.investment.thumb_height').'px)', 'name' => 'file_thumb', 'file' => $entry->file_thumb, 'file_preview' => config('images.investment.preview_file_path')])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
    </form>
@endsection
