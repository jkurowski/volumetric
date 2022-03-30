@extends('layouts.page', ['body_class' => 'page-about'])

@section('meta_title', $page->title)

@section('pageheader')
    @include('layouts.partials.page-header', ['page' => $page])
@stop

@section('content')
    <section class="pt-0">
        <div class="container">
            <div class="row flex-row-reverse position-relative">
                <div class="col-6">
                    <img src="{{ asset('/uploads/inline/volumetric-to-my.jpg') }}" alt="Zdjęcie grupowe Volumetric">
                </div>
                <div class="col-7 position-absolute pr-0 offset-absolute d-flex align-items-center">
                    <div class="offset-apla">
                        <div class="section-header text-center">
                            <span>POZNAJMY SIĘ</span>
                            <h2>Volumetric to My</h2>
                        </div>
                        <p>Nasz warszawski zespół nie jest dużą korporacją – jesteśmy spółką deweloperską, częścią <a
                                href="https://volumetric.es/" target="_blank" rel="nofollow">Grup Volumetric</a>, rodzinnego holdingu z siedzibą w Mataró nieopodal Barcelony.</p>
                        <p>&nbsp;</p>
                        <p>Wiemy, jak ważna jest dla naszych klientów niezależność oraz własna przestrzeń, dlatego staramy się sprostać ich oczekiwaniom i zapewniamy najwyższą jakość naszych usług.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-6 text-center">
                    <h2 class="mb-4">16 lat współpracy</h2>
                    <p>Specjalizujemy się głównie w budownictwie mieszkaniowym wielorodzinnym, a swoją stabilną pozycję na rynku budujemy już od 2006 roku. W tym czasie stworzyliśmy już wiele mieszkań i domów dla naszych klientów, między innymi w Warszawie, Kielcach oraz Markach.</p>
                </div>
            </div>
        </div>
        <div class="container pt-5 time-line">
            @foreach($about_investments as $investment)
            <div class="@if ($loop->even) row @elseif ($loop->odd) row flex-row-reverse @endif">
                <span class="deadline">{{ $investment->deadline }}</span>
                <div class="col-6">
                    <img src="{{ asset('/uploads/investments/thumbs/'.$investment->file_thumb) }}" alt="{{ $investment->city }} - {{ $investment->name }}">
                </div>
                <div class="col-6 d-flex align-items-center justify-content-center">
                    <div class="offset-apla">
                        <div class="section-header text-center">
                            <span>{{ $investment->city }}</span>
                            <h2>{{ $investment->name }}</h2>
                        </div>
                        <p class="text-center mb-4">{{ $investment->address }}</p>
                        <p class="text-center">{{ $investment->entry_content }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <section class="pt-0">
        <div class="container">
            <div class="row position-relative">
                <div class="col-6">
                    <img src="{{ asset('/uploads/inline/nasze-wartosci-volumetric.jpg') }}" alt="Zdjęcie grupowe Volumetric">
                </div>
                <div class="col-7 position-absolute right pr-0 offset-absolute d-flex align-items-center">
                    <div class="offset-apla">
                        <div class="section-header text-center">
                            <span>VOLUMETRIC</span>
                            <h2>Nasze wartości</h2>
                        </div>
                        <p>Wiemy, jak ważne dla nas wszystkich jest poczucie komfortu i bezpieczeństwa. Wiemy też, że życie we współczesnym świecie, może być niezwykle trudne. Stres może powodować, że wolimy spędzać cały wolny czas we własnym mieszkaniu, czy też w innym miejscu, gdzie możemy załatwiać wszystkie swoje, mniej lub bardziej pilne potrzeby.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div id="paralaxa">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-7 text-center">
                        <p>Jesteśmy członkiem <a href="https://pzfd.pl/strona-glowna/" target="_blank" rel="nofollow">Polskiego Związku Firm Deweloperskich</a> i przestrzegamy zasad Kodeksu Dobrych Praktyk, zaakceptowanego przez Urząd Ochrony Konkurencji i Konsumentów.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-0">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-7">
                    <div class="offset-apla offset-absolute">
                        <div class="section-header text-center">
                            <span>VOLUMETRIC</span>
                            <h2>Działalność społeczna</h2>
                        </div>
                        <div class="text-justify">
                            <p>Mamy otwarte serca i jesteśmy wrażliwy na potrzeby innych - małych i dużych. W miarę możliwości angażujemy się zarówno jako firma jak i osobiście w akcje wspierające ważne inicjatywy.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-4">
                    <div class="p-4">
                        <a href="{{ asset('/uploads/inline/ds-1.jpg') }}" class="swipebox"><img src="{{ asset('/uploads/inline/ds-1-thumb.jpg') }}" alt="Pomoc społeczna"></a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="p-4">
                        <a href="{{ asset('/uploads/inline/ds-2.jpg') }}" class="swipebox"><img src="{{ asset('/uploads/inline/ds-2-thumb.jpg') }}" alt="Pomoc społeczna"></a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="p-4">
                        <a href="{{ asset('/uploads/inline/ds-3.jpg') }}" class="swipebox"><img src="{{ asset('/uploads/inline/ds-3-thumb.jpg') }}" alt="Pomoc społeczna"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="maincontact" class="p-0">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-10">
                    <div class="maincontact">
                        <div class="container-fluid p-0">
                            <div class="row no-gutters">
                                <div class="col-8 ps-5 d-flex align-items-center justify-content-center">
                                    <div class="maincontact-text">
                                        <div class="section-header text-center">
                                            <span>@lang('cms.contactbox-title')</span>
                                            <h2>@lang('cms.contactbox-subtitle')</h2>
                                        </div>

                                        <ul class="mb-0 list-unstyled">
                                            <li><span class="square-icon"><img src="{{asset('svg/phone-icon.svg') }}" class="phone-svg-icon" alt="Numer telefonu"></span><a href="tel:226543838">22 654 38 38</a></li>
                                            <li><span class="square-icon"><img src="{{asset('svg/phone-icon.svg') }}" class="phone-svg-icon" alt="Numer telefonu"></span><a href="tel:664130140">664 130 140</a></li>
                                            <li><span class="square-icon"><img src="{{asset('svg/envelope-icon.svg') }}" class="envelope-svg-icon" alt="Numer telefonu"></span><a href="mailto:biuro@volumetric.pl">biuro@volumetric.pl</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-4 ps-5">
                                    <img src="{{asset('images/kontakt.jpg') }}" alt="@lang('cms.contactbox-title')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('/js/slick.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#maincarousel .row").slick({
                dots: false,
                infinite: true,
                speed: 300,
                slidesToShow: 2,
                slidesToScroll: 1
            });
        });
    </script>
@endpush
