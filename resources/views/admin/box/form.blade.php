@extends('admin.layout')
@section('meta_title', '- '.$cardTitle)

@section('content')
    @if(Route::is('admin.box.edit'))
        <form method="POST" action="{{route('admin.box.update', $entry->id)}}" enctype="multipart/form-data">
            @method('PUT')
            @else
                <form method="POST" action="{{route('admin.box.store')}}" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="container">
                        <div class="card">
                            <div class="card-head container">
                                <div class="row">
                                    <div class="col-12 pl-0">
                                        <h4 class="page-title row"><i class="fe-grid"></i><a href="{{route('admin.box.index')}}" class="p-0">Boksy z obrazkami</a><span class="d-inline-flex ml-2 mr-2">/</span>{{ $cardTitle }}</h4>
                                    </div>
                                </div>
                            </div>
                            @include('form-elements.back-route-button')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        @include('form-elements.html-input-text', ['label' => 'Nazwa', 'name' => 'title', 'value' => $entry->title, 'required' => 1])
                                        @include('form-elements.html-input-text', ['label' => 'Tekst', 'name' => 'text', 'value' => $entry->text, 'required' => 1])
                                        @include('form-elements.html-input-file', ['label' => 'Zdjęcie', 'sublabel' => '(wymiary: '.\App\Models\Boxes::IMG_WIDTH.'px / '.\App\Models\Boxes::IMG_HEIGHT.'px)', 'name' => 'file'])
                                        @include('form-elements.html-input-text', ['label' => 'Atrybut ALT zdjęcia', 'name' => 'file_alt', 'value' => $entry->file_alt])
                                        @include('form-elements.html-input-text', ['label' => 'CTA link', 'name' => 'link', 'value' => $entry->link])
                                        @include('form-elements.html-input-text', ['label' => 'CTA button', 'name' => 'link_button', 'value' => $entry->link_button])
                                        @include('form-elements.html-select', ['label' => 'CTA Okno docelowe', 'name' => 'link_target', 'selected' => $entry->link_target, 'select' => ['_self' => 'To samo okno', '_blank' => 'Nowe okno']])
                                        @include('form-elements.html-select', ['label' => 'Animacja - typ', 'name' => 'aos_animation', 'selected' => $entry->aos_animation, 'select' => [
    'fade' => 'Fade',
    'fade-up' => 'Fade Up',
    'fade-down' => 'Fade Down',
    'fade-left' => 'Fade Left',
    'fade-right' => 'Fade Right'
    ]])
                                        @include('form-elements.html-input-text', ['label' => 'Animacja - czas trwania w ms', 'name' => 'aos_duration', 'value' => $entry->aos_duration])
                                        @include('form-elements.html-input-text', ['label' => 'Animacja - czas opóźnienia w ms', 'name' => 'aos_delay', 'value' => $entry->aos_delay])
                                        @include('form-elements.html-input-text', ['label' => 'Animacja - opóźnienie w px', 'name' => 'aos_offset', 'value' => $entry->aos_offset])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
                </form>
@endsection
