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
                    <img src="https://placehold.co/796x840" alt="">
                </div>
                <div class="col-7 position-absolute pr-0 offset-absolute d-flex align-items-center">
                    <div class="offset-apla">
                        <div class="section-header text-center">
                            <span>POZNAJMY SIĘ</span>
                            <h2>Volumetric to My</h2>
                        </div>
                        <p>Nie jesteśmy dużą korporacją – jesteśmy spółką, częścią Grup Volumetric, rodzinnego holdingu z siedzibą w Mataró nieopodal Barcelony.</p>
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
                    <h2 class="mb-4">13 lat współpracy</h2>
                    <p>Specjalizujemy się głównie w budownictwie deweloperskim, a swoją stabilną pozycję na rynku budowaliśmy przez ponad 13 lat. W tym czasie stworzyliśmy już wiele mieszkań i domów dla naszych klientów, między innymi w Warszawie, Kielcach oraz Markach.</p>
                </div>
            </div>
        </div>
        <div id="maincarousel" class="container">
            <div class="row planned-list pt-5">
                @foreach($investments as $investment)
                    <div class="col-6">
                        <img src="{{ asset('/uploads/investments/thumbs/'.$investment->file_thumb) }}" alt="{{ $investment->city }} - {{ $investment->name }}">
                        <div class="offset-apla">
                            <div class="section-header text-center">
                                <span>{{ $investment->city }}</span>
                                <h2>{{ $investment->name }}</h2>
                            </div>
                            <p class="text-center mb-4">{{ $investment->address }}</p>
                            <p class="text-center">{{ $investment->entry_content }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="pt-0">
        <div class="container">
            <div class="row position-relative">
                <div class="col-6">
                    <img src="https://placehold.co/796x840" alt="">
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
                        <p>Jesteśmy od kilku lat członkiem Polskiego Związku Firm Deweloperskich i przestrzegamy zasad Kodeksu Dobrych Praktyk, zaakceptowanego przez Urząd Ochrony Konkurencji i Konsumentów.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-0">
        <div class="container">
            <div class="row flex-row-reverse position-relative">
                <div class="col-6">
                    <img src="https://placehold.co/796x840" alt="">
                </div>
                <div class="col-7 position-absolute pr-0 offset-absolute d-flex align-items-center">
                    <div class="offset-apla">
                        <div class="section-header text-center">
                            <span>VOLUMETRIC</span>
                            <h2>Działalność społeczna</h2>
                        </div>
                        <p>Donec efficitur nisi nisi, ac sagittis neque suscipit et. Nam bibendum velit tortor, non tristique dolor rutrum non. Aenean vehicula libero ac lacus fringilla, at pulvinar dui egestas. Nam malesuada vel quam eu hendrerit. Phasellus scelerisque non ex quis viverra. Nullam faucibus et erat quis gravida. Fusce mollis purus eu nulla faucibus fermentum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Ut in mattis sapien. Duis non felis lacinia purus posuere pulvinar non nec purus.</p>
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

                                        <div class="d-flex justify-content-center">
                                            <a href="" class="bttn">@lang('cms.gotoform-button')</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 ps-5">
                                    <img src="https://placehold.co/400x600" alt="">
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
