@extends('admin.layout')
@section('meta_title', '- '.$cardTitle)

@section('content')
@if(Route::is('admin.rodo.rules.edit'))
    <form method="POST" action="{{route('admin.rodo.rules.update', $entry->id)}}">
    @method('PUT')
@else
    <form method="POST" action="{{route('admin.rodo.rules.store')}}">
@endif
        @csrf
        <div class="container">
            <div class="card">
                <div class="card-head container">
                    <div class="row">
                        <div class="col-12 pl-0">
                            <h4 class="page-title row"><i class="fe-home"></i><a href="{{route('admin.rodo.rules.index')}}" class="p-0">Rodo: regułki</a><span class="d-inline-flex ml-2 mr-2">/</span>{{ $cardTitle }}</h4>
                        </div>
                    </div>
                </div>
                @include('form-elements.back-route-button')
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @if(!Request::get('lang'))
                                @include('form-elements.html-select', ['label' => 'Status', 'name' => 'status', 'selected' => $entry->status, 'select' => ['1' => 'Pokaż na liście', '2' => 'Ukryj na liście']])
                                @include('form-elements.html-select', ['label' => 'Wymagane', 'name' => 'required', 'selected' => $entry->required, 'select' => ['1' => 'Tak', '2' => 'Nie']])
                            @endif
                            @include('form-elements.html-input-text', ['label' => 'Nazwa regułki', 'name' => 'title', 'value' => $entry->title, 'required' => 1])
                            @if(!Request::get('lang'))
                                @include('form-elements.html-input-text', ['label' => 'Czas trwania regułki', 'name' => 'time', 'value' => $entry->time, 'required' => 1])
                            @endif
                            @include('form-elements.textarea-fullwidth', ['label' => 'Treść regułki', 'name' => 'text', 'value' => $entry->text, 'rows' => 11, 'class' => 'tinymce', 'required' => 1])
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="lang" value="{{$current_locale}}">
            @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz regułkę'])
        </div>
    </form>
@if(Request::get('lang'))
    @push('scripts')
        <script>
            $('#title').attr('readonly', true);
        </script>
    @endpush
@endif
@include('form-elements.tintmce')
@endsection
