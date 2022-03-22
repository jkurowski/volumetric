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
                <div class="card-head container">
                    <div class="row">
                        <div class="col-12 pl-0">
                            <h4 class="page-title"><i class="fe-book-open"></i><a href="{{route('admin.developro.index')}}" class="p-0">Inwestycje</a><span class="d-inline-flex me-2 ms-2">/</span>{{ $cardTitle }}</h4>
                        </div>
                    </div>
                </div>
                @include('form-elements.back-route-button')
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 pb-5"><div id="map"></div></div>
                        <div class="col-12">
                            @include('form-elements.html-select', [
                                'label' => 'Status inwestycji',
                                'name' => 'status',
                                'selected' => $entry->status,
                                'select' => [
                                    '1' => 'Inwestycja w sprzedaży',
                                    '3' => 'Inwestycja planowana'
                            ]])
                            @include('form-elements.html-input-text', ['label' => 'Nazwa inwestycji', 'name' => 'name', 'value' => $entry->name, 'required' => 1])
                            @include('form-elements.html-input-text', ['label' => 'Adres inwestycji', 'name' => 'address', 'value' => $entry->address, 'required' => 1])
                            @include('form-elements.html-input-text', ['label' => 'Szerokość geograficzna', 'name' => 'lat', 'value' => $entry->lat, 'required' => 1])
                            @include('form-elements.html-input-text', ['label' => 'Długość geograficzna', 'name' => 'lng', 'value' => $entry->lng, 'required' => 1])
                            @include('form-elements.html-input-text', ['label' => 'Zoom', 'name' => 'zoom', 'value' => $entry->zoom, 'required' => 1])
                            @include('form-elements.html-input-text', ['label' => 'Miasto inwestycji', 'name' => 'city', 'value' => $entry->city, 'required' => 1])
                            @include('form-elements.html-input-text', ['label' => 'Strona inwestycji', 'name' => 'url', 'value' => $entry->url, 'required' => 1])
                            @include('form-elements.html-input-text', ['label' => 'Krótki opis na liście', 'name' => 'entry_content', 'value' => $entry->entry_content])
                            @include('form-elements.html-input-file', ['label' => 'Miniaturka', 'sublabel' => '(wymiary: '.config('images.investment.thumb_width').'px / '.config('images.investment.thumb_height').'px)', 'name' => 'file_thumb', 'file' => $entry->file_thumb, 'file_preview' => config('images.investment.preview_file_path')])

                            <input type="hidden" name="lang" value="{{$current_locale}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
    </form>
@push('scripts')
    <link href="{{ asset('/css/leaflet.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/leaflet.js') }}" charset="utf-8"></script>
    <script>
        function setOnLoad($lat, $lng, $zoom){
            $('input[name="zoom"]').val($zoom);
            $('input[name="lat"]').val($lat);
            $('input[name="lng"]').val($lng);
            map.setView([$lat, $lng], $zoom);
        }

        function loadInputs($lat, $lng){
            $('input[name="lat"]').val($lat);
            $('input[name="lng"]').val($lng);
        }

        function setZoom($zoom){
            $('input[name="zoom"]').val($zoom);
        }

        let map = L.map('map').setView([52.227388, 21.011063], 13),
            theMarker = {},
            zoom = map.getZoom(),
            latLng = map.getCenter();

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        @if($entry->lat && $entry->lng && $entry->zoom)
        setOnLoad('{{ $entry->lat }}', '{{ $entry->lng }}', '{{ $entry->zoom }}');
        theMarker = L.marker([
            '{{ $entry->lat }}',
            '{{ $entry->lng }}'
        ], {
            draggable:'true'
        }).addTo(map);
        @else
        setOnLoad(latLng.lat, latLng.lng, zoom);
        theMarker = L.marker([
            '52.227388',
            '21.011063'
        ], {
            draggable:'true'
        }).addTo(map);
        @endif

        map.on('zoomend', function() {
            setZoom(map.getZoom());
        });

        map.on('click', function(e) {
            let lat = e.latlng.lat,
                lng = e.latlng.lng;
            loadInputs(lat, lng);

            if (theMarker !== undefined) {
                map.removeLayer(theMarker);
            }
            theMarker = L.marker([lat, lng], {
                draggable:'true'
            }).addTo(map);
        });

        theMarker.on('dragend', function(event) {
            const latlng = event.target.getLatLng();
            loadInputs(latlng.lat, latlng.lng);
        });
    </script>
@endpush
@endsection
