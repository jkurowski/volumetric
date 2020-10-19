@extends('admin.layout')
@section('content')
    @if(Route::is('admin.rodo.rules.edit'))
        <form method="POST" action="{{route('admin.rodo.rules.update', $entry)}}" enctype="multipart/form-data">
            @method('PUT')
            @else
                <form method="POST" action="{{route('admin.rodo.rules.store')}}" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="container">
                        <div class="card">
                            <div class="card-head container">
                                <div class="row">
                                    <div class="col-12 pl-0">
                                        <h4 class="page-title row"><i class="fe-home"></i><a href="{{route('admin.rodo.rules.index')}}">Rodo: regułki</a><span class="d-inline-flex ml-2 mr-2">-</span>{{ $cardTitle }}</h4>
                                    </div>
                                </div>
                            </div>
                            @include('form-elements.back-route-button')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        @include('form-elements.select', ['label' => 'Status', 'name' => 'status', 'selected' => $entry->status, 'options' => ['1' => 'Pokaż na liście', '2' => 'Ukryj na liście']])
                                        @include('form-elements.select', ['label' => 'Wymagane', 'name' => 'required', 'selected' => $entry->required, 'options' => ['1' => 'Tak', '2' => 'Nie']])
                                        @include('form-elements.input-text', ['label' => 'Nazwa regułki', 'name' => 'title', 'value' => $entry->title])
                                        @include('form-elements.input-text', ['label' => 'Czas trwania regułki', 'name' => 'time', 'value' => $entry->time])
                                        @include('form-elements.textarea', ['label' => 'Treść regułki', 'name' => 'text', 'value' => $entry->text, 'rows' => 11, 'class' => 'tinymce'])
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz piętro'])
                    </div>
                </form>
        @include('form-elements.tintmce')
@endsection
