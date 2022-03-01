<div class="container" id="roomsList">
    @if($properties->count() > 0)
    @foreach($properties as $room)
        <div class="row">
            <div class="col">
                @if($investment->type == 1)
                        <a href="{{route('front.investment.building.property.index', ['investment' => $investment->id, 'floor' => $room->floor_id, 'building' => $room->building_id, 'property' => $room->id])}}">{{$room->name}}</a>
                @endif

                @if($investment->type == 2)
                        <a href="{{route('front.investment.property.index', ['investment' => $investment->id, 'floor' => $room->floor_id, 'property' => $room->id])}}">{{$room->name}}</a>
                @endif

                @if($investment->type == 3)
                    <a href="{{route('front.investment.house.index', ['investment' => $investment->id, 'property' => $room->id])}}">{{$room->name}}</a>
                @endif
            </div>
            <div class="col">
                @if($room->file)
                <img src="/investment/property/list/{{$room->file}}" alt="{{$room->name}}">
                @endif
            </div>
            <div class="col">
                <ul class="mb-0 list-unstyled">
                    <li>pokoje: <b>{{$room->rooms}}</b></li>
                    <li>pow.: <b>{{$room->area}} m<sup>2</sup></b></li>
                </ul>
            </div>
            <div class="col justify-content-center">
                <span class="badge room-list-status-{{ $room->status }}">{{ roomStatus($room->status) }}</span>
            </div>
            <div class="col justify-content-end">

                @if($investment->type == 1)
                <a href="{{route('front.investment.building.property.index', ['investment' => $investment->id, 'floor' => $room->floor_id, 'building' => $room->building_id, 'property' => $room->id])}}" class="bttn bttn-sm">Zobacz</a>
                @endif

                @if($investment->type == 2)
                <a href="{{route('front.investment.property.index', ['investment' => $investment->id, 'floor' => $room->floor_id, 'property' => $room->id])}}" class="bttn bttn-sm">Zobacz</a>
                @endif

                @if($investment->type == 3)
                <a href="{{route('front.investment.house.index', ['investment' => $investment->id, 'property' => $room->id])}}" class="bttn bttn-sm">Zobacz</a>
                @endif

            </div>
        </div>
    @endforeach
    @else
        <div class="row">
            <div class="col-12 text-center">
                <b>Brak wyników</b>
            </div>
        </div>
    @endif
</div>
