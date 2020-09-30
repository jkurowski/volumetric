@extends('layouts.page', ['body_class' => 'investments'])

@section('content')
    <div class="container">
        <div class="row border-bottom pb-3 mb-3">
            <div class="col-8">
                <h1>{{$investment->name}} @if($investment->type == 1) - {{$building->name}} @endif - {{$floor->name}} - {{$property->name}}</h1>
            </div>
            <div class="col-4 text-right">
                <a href="
                @if($investment->type == 1)
                {{route('front.investment.building.floor.index', [$investment, $building, $floor])}}
                @else
                {{route('front.investment.floor.index', [$investment, $floor])}}
                @endif
                " class="bttn bttn-right"><i class="las la-arrow-left"></i> Wróć do listy</a>
            </div>
        </div>
        <div class="row">
            <div class="col-6 property-desc">
                <h2>{{$property->name}}</h2>
                <ul class="list-unstyled">
                    <li>Pokoje:<span>{{$property->rooms}}</span></li>
                    <li>Powierzchnia:<span>{{$property->area}} m<sup>2</sup></span></li>
                    <li>Piętro:<span>xxx</span></li>
                    <li>Aneks/Kuchnia:<span>xxx</span></li>
                    <li>Wystawa okienna:<span>xxx<br></span></li>
                </ul>
            </div>
            <div class="col-6 d-flex align-items-center justify-content-center pl-5">
                @if($property->file)
                    <a href="/investment/property/{{$property->file}}"><img src="/investment/property/thumbs/{{$property->file}}" alt="{{$property->name}}"></a>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                [ Form ]
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
