@extends('layouts.page', ['body_class' => 'investments'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="border-bottom pb-3 mb-3">Inwestycje</h1>
            </div>
            @foreach($list as $investment)
            <div class="col-12 p-3">
                <a href="{{route('front.investment.show', $investment->id)}}">{{$investment->name}}</a>
            </div>
            @endforeach
        </div>
    </div>
@endsection
@push('scripts')

@endpush
