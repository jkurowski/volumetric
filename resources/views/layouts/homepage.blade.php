<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ settings()->get("page_title") }}</title>

    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ settings()->get("page_description") }}">
    <meta name="robots" content="{{ settings()->get("page_robots") }}">
    <meta name="author" content="{{ settings()->get("page_author") }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Styles -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/styles.min.css') }}" rel="stylesheet">

    @stack('style')
</head>
<body class="{{ !empty($body_class) ? $body_class : '' }}">
@include('layouts.partials.header')

<div id="slider">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-2"></div>
            <div class="col-8 d-flex align-items-center justify-content-center">
                <div class="apla">
                    <p>Nowe apartamenty na warszawskim Powiślu</p>
                    <h2>Górnośląska 6</h2>
                    <a href="" class="bttn">@lang('cms.slider-button')</a>
                </div>
            </div>
            <div class="col-2">

            </div>
        </div>
    </div>
</div>

<section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header text-center">
                    <span>OFERTA</span>
                    <h2>Projekty w sprzedaży</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <ul class="mb-0 list-unstyled invest-list-nav">
                    <li><a href="">Górnośląska 6</a></li>
                    <li class="active"><a href="">Dom nad stawem Koziorożca</a></li>
                    <li><a href="">Szczęśliwicka 42</a></li>
                    <li><a href="">Przy bażantarni</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container invest-list-carousel">
        <div class="row invest-list-item">
            <div class="col-6">
                <a href=""><img src="https://placehold.co/796x450" alt=""></a>
            </div>
            <div class="col-3 d-flex align-items-center">
                <div class="invest-list-desc text-center">
                    <h3>Dom nad stawem Koziorożca</h3>
                    <ul class="mb-0 list-unstyled">
                        <li class="text-uppercase">Termin oddania: kwiecień 2022</li>
                        <li class="text-uppercase">Nowe Włochy | ul. Globusowa 23</li>
                        <li>Nowa inwestycja nad Stawem Koziorożca w warszawskich Włochach</li>
                    </ul>
                    <a href="" class="bttn">@lang('cms.slider-button')</a>
                </div>
            </div>
            <div class="col-3">
                <a href=""><img src="https://placehold.co/386x450" alt=""></a>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row position-relative">
            <div class="col-6">
                <img src="https://placehold.co/796x840" alt="">
            </div>
            <div class="col-7 offset-5 position-absolute pl-0 offset-absolute d-flex align-items-center">
                <div class="offset-apla">
                    <div class="section-header text-center">
                        <span>DLACZEGO MY</span>
                        <h2>Volumetric to</h2>
                    </div>
                    <ul class="mb-0 list-unstyled">
                        <li>
                            <h3>Gwarancja bezpieczeństwa</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim</p>
                        </li>
                        <li>
                            <h3>Najwyższa jakość</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim</p>
                        </li>
                        <li>
                            <h3>Realizacja zawsze na czas</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="maincarousel">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <img src="https://placehold.co/386x464" alt="">
            </div>
            <div class="col-3">
                <img src="https://placehold.co/386x217" alt="">
                <img src="https://placehold.co/386x217" alt="">
            </div>
            <div class="col-3">
                <img src="https://placehold.co/386x464" alt="">
            </div>
            <div class="col-3">
                <img src="https://placehold.co/386x217" alt="">
                <img src="https://placehold.co/386x217" alt="">
            </div>
            <div class="col-3">
                <img src="https://placehold.co/386x464" alt="">
            </div>
            <div class="col-3">
                <img src="https://placehold.co/386x217" alt="">
                <img src="https://placehold.co/386x217" alt="">
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row flex-row-reverse position-relative">
            <div class="col-6">
                <img src="https://placehold.co/796x840" alt="">
            </div>
            <div class="col-7 position-absolute pr-0 offset-absolute d-flex align-items-center">
                <div class="offset-apla">
                    <div class="section-header text-center">
                        <span>POZNAJMY SIĘ</span>
                        <h2>Nowe mieszkania deweloperskie w Warszawie</h2>
                    </div>
                    <p>Firma Volumetric koncentruje się głównie na działalności deweloperskiej. Jest częścią Grup Volumetric – rodzinnego holdingu z siedzibą w Mataro nieopodal Barcelony.</p>
                    <p>&nbsp;</p>
                    <p>Satysfakcja naszych klientów jest naszym priorytetem. Cały zespół firmy i wszyscy współpracownicy dokładają wszelkich starań, aby zapewnić najwyższą jakość naszych usług. Nasze umiejętności i wiedza sa zawsze do dyspozycji naszych klientów.</p>
                    <p>&nbsp;</p>
                    <p>Przez ponad 10 lat działalności w Polsce, udało nam się potwierdzić swoją stabilną pozycję na rynku. Z powodzeniem zrealizowaliśmy dziewięć osiedli lub budynków w Warszawie, Kielcach i Markach. Obecnie przygotowujemy kolejne inwestycje i wciąż poszukujemy nowych gruntów pod zabudowę mieszkaniową.</p>

                    <div class="d-flex justify-content-center">
                        <a href="" class="bttn">@lang('cms.goformore-button')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="maincontact">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-10">
                <div class="maincontact">
                    <div class="container-fluid p-0">
                        <div class="row no-gutters">
                            <div class="col-8 ps-5 d-flex align-items-center justify-content-center">
                                <div class="maincontact-text">
                                    <div class="section-header text-center">
                                        <span>KONTAKT</span>
                                        <h2>Przygotujemy ofertę specjalnie dla Ciebie</h2>
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

@include('layouts.partials.footer')

@include('layouts.partials.cookies')

<!-- jQuery -->
<script src="{{ asset('/js/jquery.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/slick.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/app.js') }}" charset="utf-8"></script>

@stack('scripts')

<script type="text/javascript">
    $(document).ready(function(){
        $("#slider ul").responsiveSlides({
            auto:true,
            pager:false,
            nav:true,
            timeout:4000,
            random:false,
            speed:500
        });

        $("#maincarousel .row").slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1
        });
    });
    $(window).load(function() {
        $("#slider ul").show();
        $(".rslides_nav").show();
    });
</script>

</body>
</html>
