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
    @foreach($sliders as $panel)
    <div class="container-fluid h-100" style="background-image: url('{{ asset('/uploads/slider/'.$panel->file) }}')">
        <div class="row h-100 d-flex justify-content-center">
            <div class="col-8 d-flex align-items-center justify-content-center">
                <div class="apla">
                    <p>{{ $panel->subtitle }}</p>
                    <h2>{{ $panel->title }}</h2>
                    <a href="{{ $panel->link }}" class="bttn">@lang('cms.slider-button')</a>
                </div>
            </div>
        </div>
        <div class="container-opacity" style="background: rgba(0,0,0, {{ $panel->opacity }})"></div>
    </div>
    @endforeach
</div>

<section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header text-center">
                    <span>@lang('cms.offerbox-title')</span>
                    <h2>@lang('cms.offerbox-subtitle')</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <ul class="mb-0 list-unstyled invest-list-nav">
                    @foreach($investments as $investment)
                    <li>{{ $investment->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="container invest-list-carousel">

        @foreach($investments as $investment)
        <div class="row invest-list-item">
            <div class="col-6">
                <a href="{{ $investment->url }}"><img src="{{ asset('/uploads/investments/thumbs/'.$investment->file_thumb) }}" alt="{{ $investment->city }} - {{ $investment->name }}"></a>
            </div>
            <div class="col-3 d-flex align-items-center">
                <div class="invest-list-desc text-center">
                    <h3>Dom nad stawem Koziorożca</h3>
                    <ul class="mb-0 list-unstyled">
                        <li class="text-uppercase">@lang('cms.deadline-date'): kwiecień 2022</li>
                        <li class="text-uppercase">{{ $investment->city }} | {{ $investment->address }}</li>
                        <li>{{ $investment->entry_content }}</li>
                    </ul>
                    <a href="{{ $investment->url }}" class="bttn" target="_blank">@lang('cms.slider-button')</a>
                </div>
            </div>
            <div class="col-3">
                <a href=""><img src="https://placehold.co/386x450" alt=""></a>
            </div>
        </div>
        @endforeach
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
                        <span>@lang('cms.whyusbox-title')</span>
                        <h2>@lang('cms.whyusbox-subtitle')</h2>
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

@include('layouts.partials.footer')

@include('layouts.partials.cookies')

<!-- jQuery -->
<script src="{{ asset('/js/jquery.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/slick.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/app.min.js') }}" charset="utf-8"></script>

@stack('scripts')

<script type="text/javascript">
    $(document).ready(function(){
        $("#slider").responsiveSlides({
            auto:true,
            pager:false,
            nav:true,
            timeout:6000,
            random:false,
            speed:1000
        });

        $(".invest-list-carousel").slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1,
            asNavFor: '.invest-list-nav'
        });
        $('.invest-list-nav').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.invest-list-carousel',
            dots: false,
            centerMode: false,
            focusOnSelect: true,
            variableWidth: true
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
