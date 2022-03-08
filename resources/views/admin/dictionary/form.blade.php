@extends('admin.layout')
@section('content')
<form method="POST" action="{{route('admin.dictionary.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="container">
        <div class="card">
            <div class="card-head container">
                <div class="row">
                    <div class="col-12 pl-0">
                        <h4 class="page-title">
                             <i class="fe-book-open"></i><a href="{{route('admin.dictionary.index')}}">Przeglądaj słownik</a><span class="d-inline-flex ms-2 me-2">/</span><a href="{{route('admin.dictionary.show', $locale)}}">{{ $available_locales[$locale] }}</a><span class="d-inline-flex ms-2 me-2">/</span>{{ $cardTitle }}

                        </h4>
                    </div>
                </div>
            </div>
            @include('form-elements.back-route-button')
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @include('form-elements.input-text', ['label' => $slug, 'name' => 'translation', 'value' => $entry, 'required' => 1])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="dictionary_slug" value="{{ $slug }}">
    <input type="hidden" name="dictionary_locale" value="{{ $locale }}">
    @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
</form>
@endsection
