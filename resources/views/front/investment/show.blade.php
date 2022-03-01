@extends('layouts.page', ['body_class' => 'investments'])

@section('meta_title', 'Inwestycje - '.$investment->name)

@section('pageheader')
    @include('layouts.partials.page-header', ['page' => $page])
@stop

@section('content')
    <div class="container">
        @if($investment->type == 1)
            <div class="row">
                <div class="col-12">
                    @if($investment->plan)
                        <div id="plan">
                            <div id="plan-holder"><img src="{{ asset('/investment/plan/'.$investment->plan->file.'') }}" alt="{{$investment->name}}" id="invesmentplan" usemap="#invesmentplan"></div>
                            <map name="invesmentplan">
                                @if($investment->buildings)
                                    @foreach($investment->buildings as $building)
                                        <area
                                            shape="poly"
                                            href="{{route('front.investment.building.index', [$investment, $building])}}"
                                            alt="{{$building->slug}}"
                                            data-item="{{$building->id}}" title="{{$building->name}}"
                                            data-roomnumber="{{$building->number}}"
                                            data-roomtype="{{$building->typ}}"
                                            data-roomstatus="{{$building->status}}"
                                            coords="@if($building->html) {{cords($building->html)}} @endif">
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
                        <a href="{{route('front.investment.building.index', [$investment, $building])}}">{{$building->name}}</a>
                    </div>
                @endforeach
            </div>
        @endif

        @if($investment->type == 2)
        <div class="row">
            <div class="col-12">
                @if($investment->plan)
                    <div id="plan">
                        <div id="plan-holder"><img src="{{ asset('/investment/plan/'.$investment->plan->file.'') }}" alt="{{$investment->name}}" id="invesmentplan" usemap="#invesmentplan"></div>
                        <map name="invesmentplan">
                            @foreach($investment->floors as $floor)
                                @if($floor->html)
                                <area
                                    shape="poly"
                                    href="{{route('front.investment.floor.index', [$investment, $floor])}}"
                                    title="{{$floor->name}}"
                                    alt="floor-{{$floor->id}}"
                                    data-item="{{$floor->id}}"
                                    data-floornumber="{{$floor->id}}"
                                    data-floortype="{{$floor->type}}"
                                    coords="@if($floor->html) {{cords($floor->html)}} @endif">
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
                        <div id="plan-holder"><img src="{{ asset('/investment/plan/'.$investment->plan->file.'') }}" alt="{{$investment->name}}" id="invesmentplan" usemap="#invesmentplan"></div>
                        <map name="invesmentplan">
                            @if($investment->houses)
                                @foreach($investment->houses as $house)
                                    <area
                                        shape="poly"
                                        href="{{route('front.investment.house.index', [$investment, $house])}}"
                                        title="{{$house->name}}"
                                        alt="{{$house->slug}}"
                                        data-item="{{$house->id}}"
                                        data-roomnumber="{{$house->number}}"
                                        data-roomtype="{{$house->typ}}"
                                        data-roomstatus="{{$house->status}}"
                                        coords="@if($house->html) {{cords($house->html)}} @endif">
                                @endforeach
                            @endif
                        </map>
                    </div>
                @endif
            </div>
        </div>
        @endif

        @include('front.investment_shared.filtr', ['area_range' => $investment->area_range])

        @include('front.investment_shared.sort')

        <div class="row">
            @include('front.investment_shared.list', ['investment' => $investment])
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('/js/plan/imagemapster.js') }}" charset="utf-8"></script>
    <script src="{{ asset('/js/plan/plan.js') }}" charset="utf-8"></script>
@endpush
