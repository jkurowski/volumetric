@extends('admin.layout')
@section('content')
@if(Route::is('admin.slider.edit'))
    <form method="POST" action="{{route('admin.slider.update', $entry->id)}}" enctype="multipart/form-data">
        @method('PUT')
@else
    <form method="POST" action="{{route('admin.slider.store')}}" enctype="multipart/form-data">
@endif
        @csrf
        <div class="container">
            <div class="card">
                @include('form-elements.card-header')
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @include('form-elements.input-text', ['label' => 'Nazwa', 'name' => 'title', 'value' => $entry->title, 'required' => 1])
                            @include('form-elements.input-file', ['label' => 'Plik', 'sublabel' => '(wymiary: '.\App\Slider::IMG_WIDTH.'px / '.\App\Slider::IMG_HEIGHT.'px)', 'name' => 'file'])
                            @include('form-elements.input-text', ['label' => 'CTA link', 'name' => 'link', 'value' => $entry->link])
                            @include('form-elements.input-text', ['label' => 'CTA button', 'name' => 'link_button', 'value' => $entry->link_button])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
    </form>
@endsection
