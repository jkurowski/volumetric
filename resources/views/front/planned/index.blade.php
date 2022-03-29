@extends('layouts.page', ['body_class' => 'page-planned'])

@section('meta_title', 'Inwestycje w planach')

@section('pageheader')
    @include('layouts.partials.page-header', ['page' => $page])
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 pb-5">
            <div id="map"></div>
        </div>
    </div>

    <div class="row planned-list">
        @foreach($investments as $investment)
        <div class="col-6">
            <img src="{{ asset('/uploads/investments/thumbs/'.$investment->file_thumb) }}" alt="{{ $investment->city }} - {{ $investment->name }}">
            <div class="offset-apla">
                <div class="section-header text-center">
                    <span>{{ $investment->city }}</span>
                    <h2>{{ $investment->name }}</h2>
                </div>
                <p class="text-center mb-4">{{ $investment->address }}</p>
                @if($investment->start_date)<p class="text-center mb-4"><b>{{ $investment->start_date }}</b></p>@endif
                <p class="text-center">{{ $investment->entry_content }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
    <link href="{{ asset('/css/leaflet.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/leaflet.js') }}" charset="utf-8"></script>
    <script>
        const tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            'attribution': 'Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
        });

        const featureGroup = L.featureGroup([
            @foreach($investments as $i)
            L.marker([{{ $i->lat }}, {{ $i->lng }}]).bindPopup('<h4>{{ $i->name }}</h4><p>{{ $i->city }} | {{ $i->address }}</p>'),
            @endforeach
        ]);

        let map = new L.Map('map', {
            'center': [0, 0],
            'zoom': 0,
            'layers': [tileLayer, featureGroup]
        });

        map.fitBounds(featureGroup.getBounds());
        map.on('popupclose', function(e) {
            map.fitBounds(featureGroup.getBounds());
        });
    </script>
@endpush
