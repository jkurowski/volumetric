@extends('admin.layout')
@section('content')
    @if(Route::is('admin.gallery.edit'))
        <form method="POST" action="{{route('admin.gallery.update', $entry)}}" enctype="multipart/form-data">
        @method('PUT')
    @else
        <form method="POST" action="{{route('admin.gallery.store')}}" enctype="multipart/form-data">
            @endif
            @csrf
            <div class="container">
                <div class="card">
                    <div class="card-head container">
                        <div class="row">
                            <div class="col-12 pl-0">
                                <h4 class="page-title row"><i class="fe-home"></i><a href="{{route('admin.gallery.index')}}">Galeria</a><span class="d-inline-flex ml-2 mr-2">/</span>{{ $cardTitle }}</h4>
                            </div>
                        </div>
                    </div>
                    @include('form-elements.back-route-button')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @include('form-elements.input-text', ['label' => 'Nazwa', 'name' => 'name', 'value' => $entry->name, 'required' => 1])
                                @include('form-elements.textarea', ['label' => 'Opis', 'name' => 'text', 'value' => $entry->text])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
        </form>
@endsection
