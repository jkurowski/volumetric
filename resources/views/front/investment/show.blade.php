@extends('layouts.page', ['body_class' => 'investments'])
@section('meta_title', $investment->name)

@section('content')
    <div class="container">
        <div class="row border-bottom pb-3 mb-3">
            <div class="col-8">
                <h1>{{$investment->name}}</h1>
            </div>
            <div class="col-4 text-right">
                <a href="{{route('front.investment.index')}}" class="bttn bttn-right"><i class="las la-arrow-left"></i> Wróć do listy</a>
            </div>
        </div>

        @if($investment->type == 1)
            <div class="row">
                <div class="col-12">
                    @if($investment->plan)
                        <div id="plan">
                            <div id="plan-holder"><img src="/investment/plan/{{$investment->plan->file}}" alt="{{$investment->name}}" id="invesmentplan" usemap="#invesmentplan"></div>
                            <map name="invesmentplan">
                                @if($investment->buildings)
                                    @foreach($investment->buildings as $building)
                                        <area shape="poly" href="{{route('front.investment.building.index', [$investment, $building])}}" data-item="{{$building->id}}" title="{{$building->name}}" alt="{{$building->slug}}" data-roomnumber="{{$building->number}}" data-roomtype="{{$building->typ}}" data-roomstatus="{{$building->status}}" coords="@if($building->html) {{cords($building->html)}} @endif">
                                    @endforeach
                                @endif
                            </map>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                @foreach($investment->buildings as $building)
                    <div class="col-12 p-3">
                        <a href="">{{$building->name}}</a>
                    </div>
                @endforeach
            </div>
        @endif

        @if($investment->type == 2)
        <div class="row">
            <div class="col-12">
                @if($investment->plan)
                    <div id="plan">
                        <div id="plan-holder"><img src="/investment/plan/{{$investment->plan->file}}" alt="{{$investment->name}}" id="invesmentplan" usemap="#invesmentplan"></div>
                        <map name="invesmentplan">
                            @foreach($investment->floors as $floor)
                                @if($floor->html)
                                <area shape="poly" href="{{route('front.investment.floor.index', [$investment, $floor])}}" data-item="{{$floor->id}}" title="{{$floor->name}}" alt="floor-{{$floor->id}}" data-floornumber="{{$floor->id}}" data-floortype="{{$floor->type}}" coords="{{cords($floor->html)}}">
                                @endif
                            @endforeach
                        </map>
                    </div>
                @endif
            </div>
        </div>
        @endif

        @if($investment->type == 3)
        <div class="row">
            <div class="col-12 p-0">
                @if($investment->plan)
                    <div id="plan">
                        <div id="plan-holder"><img src="/investment/plan/{{$investment->plan->file}}" alt="{{$investment->name}}" id="invesmentplan" usemap="#invesmentplan"></div>
                        <map name="invesmentplan">

                        </map>
                    </div>
                @endif
            </div>
        </div>
        @endif

        @include('front.investment_shared.filtr')

        @include('front.investment_shared.sort')

        <div class="row">
            @include('front.investment_shared.list', ['investment' => $investment])
        </div>
    </div>
@endsection
@push('scripts')
    @if($investment->type == 2)
    <script src="/js/plan/imagemapster.js" charset="utf-8"></script>
    <script src="/js/plan/plan.js" charset="utf-8"></script>
    @endif
@endpush
