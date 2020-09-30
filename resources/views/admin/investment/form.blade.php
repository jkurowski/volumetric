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
                    @include('form-elements.card-header')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @include('form-elements.select', ['label' => 'Typ inwestycji', 'name' => 'type', 'selected' => $entry->type, 'options' => ['1' => 'Inwestycja osiedlowa', '2' => 'Inwestycja budynkowa', '3' => 'Inwestycja z domami']])
                                @include('form-elements.select', ['label' => 'Status inwestycji', 'name' => 'status', 'selected' => $entry->status, 'options' => ['1' => 'Inwestycja w sprzedaży', '2' => 'Inwestycja zakończona', '3' => 'Inwestycja planowana']])
                                @include('form-elements.input-text', ['label' => 'Nazwa inwestycji', 'name' => 'name', 'value' => $entry->name, 'required' => 1])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(Route::is('admin.developro.edit'))
                <input type="hidden" name="article_id" value="{{$entry->id}}">
            @endif
            @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
        </form>
@endsection
