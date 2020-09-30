@extends('layouts.page', ['body_class' => 'investments'])
@section('meta_title', $investment->name)

@section('content')
    <div class="container">
        <div class="row border-bottom pb-3 mb-3">
            <div class="col-8">
                <h1>{{$investment->name}} - {{$building->name}}</h1>
            </div>
            <div class="col-4 text-right">
                <a href="{{route('front.investment.show', $investment)}}" class="bttn bttn-right"><i class="las la-arrow-left"></i> Wróć do listy</a>
            </div>
        </div>

        <div class="row">
            @foreach($investment->buildingFloors as $floor)
                <div class="col-12 p-3">
                    <a href="{{route('front.investment.building.floor.index', [$investment, $building, $floor])}}">{{$floor->name}}</a>
                </div>
            @endforeach
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <h2>Mieszkania w inwestycji</h2>
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
