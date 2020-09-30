@extends('layouts.page', ['body_class' => 'investments'])
@section('meta_title', $investment->name .' - '.$investment->floor->name)

@section('content')
    <div class="container">
        <div class="row border-bottom pb-3 mb-3">
            <div class="col-8">
                <h1>{{$investment->name}} - {{$investment->building->name}} - {{$investment->floor->name}}</h1>
            </div>
            <div class="col-4 text-right">
                <a href="{{route('front.investment.building.index', [$investment, $investment->building])}}" class="bttn bttn-right"><i class="las la-arrow-left"></i> Wróć do listy</a>
            </div>
        </div>

        @include('front.investment_shared.filtr')

        @include('front.investment_shared.sort')

        <div class="row">
            @include('front.investment_shared.list', ['investment' => $investment])
        </div>
    </div>
@endsection
@push('scripts')

@endpush
