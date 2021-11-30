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
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    @stack('style')
</head>
<body class="{{ !empty($body_class) ? $body_class : '' }}">
<div class="page-header">
    @include('layouts.partials.header')

    @yield('pagheader')
</div>

<div id="slider" class="clearfix">
    <ul class="rslides list-unstyled mb-0">
        @foreach ($sliders as $s)
            <li>
                <img src="{{asset('uploads/slider/'.$s->file) }}" alt="{{ $s->title }}">
                <div class="apla">
                    <h2>{{ $s->title }}<span></span></h2>
                </div>
            </li>
        @endforeach
    </ul>
</div>

<section>
    <div id="main-about">
        <div class="container">
            <div class="row">
                <div class="col-6 pe-5">
                    <div class="img-left-offset">
                        <img src="https://archcode.dexignzone.com/xhtml/images/about/about1.jpg" alt="">
                    </div>
                </div>
                <div class="col-6">
                    <div class="main-about-header">
                        <h6 class="sub-title">Kilka słów o nas</h6>
                        <h2 class="title">DeveloPRO to zespół specjalistów z wieloletnim doświadczeniem w branży nieruchomości.</h2>
                    </div>
                    <p>Postanowiliśmy połączyć siły, gdyż wszystkie realizacje przy których współpracowaliśmy osiągnęły założone cele rynkowe. Dzięki nam zrealizujesz swoją inwestycję skutecznie, unikając niepotrzebnych błędów i z budzącym zadowolenie zyskiem. Dzięki eksperckiej wiedzy i doświadczeniu interdyscyplinarnego zespołu nasi klienci efektywniej wdrażają atrakcyjniejsze rynkowo nieruchomości, które za pomocą innowacyjnych narzędzi skutecznie sprzedają.</p>
                    <a href="" class="bttn mt-4">Czytaj więcej</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="whatwedo" style="background: #f8f8f8 url('https://archcode.dexignzone.com/xhtml/images/background/pattern3.png')">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h6 class="sub-title">Co robimy?</h6>
                <h2 class="title">Bezkonkurencyjna oferta i najwięcej zrealizowanych projektów w Polsce</h2>
            </div>
            <div class="col-8">
                <div class="row">
                    <div class="col-6">
                        <div class="icon-wrapper">
                            <div class="icon">
                                <i class="las la-chart-line"></i>
                            </div>
                            <div class="icon-content">
                                <h4 class="title">Analiza Rynkowa Inwestycji</h4>
                                <p class="small-text">Analiza potencjału rynkowego inwestycji oraz profilu potrzeb odbiorców w przełożeniu na założenia do projektu.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="icon-wrapper">
                            <div class="icon">
                                <i class="las la-chess-knight"></i>
                            </div>
                            <div class="icon-content">
                                <h4 class="title">Przygotowanie Strategii Komunikacji</h4>
                                <p class="small-text">Budowa profilu motywacyjnego klienta, opracowanie analizy SWOT/VRIO i skupienie nad dźwignią strategiczną.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="icon-wrapper">
                            <div class="icon">
                                <i class="las la-user-tie"></i>
                            </div>
                            <div class="icon-content">
                                <h4 class="title">Pełna Obsługa Inwestycji</h4>
                                <p class="small-text">Stworzenie strony internetowowej, wdrożenie narzędzi i wykorzystanie najskuteczniejszych kanałów dotarcia do właściwych klientów.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="icon-wrapper">
                            <div class="icon">
                                <i class="las la-briefcase"></i>
                            </div>
                            <div class="icon-content">
                                <h4 class="title">Marketing</h4>
                                <p class="small-text">Obsługa 360*: strategia marketingowa, skuteczne narzędzia, prowadzenie e-kampanii i obecności w social media.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="icon-wrapper">
                            <div class="icon">
                                <i class="las la-share-alt"></i>
                            </div>
                            <div class="icon-content">
                                <h4 class="title">Social Media</h4>
                                <p class="small-text">Prowadzenie i analiza kont w Social Media.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="icon-wrapper">
                            <div class="icon">
                                <i class="las la-chalkboard-teacher"></i>
                            </div>
                            <div class="icon-content">
                                <h4 class="title">Sprzedaż i Szkolenia</h4>
                                <p class="small-text">Przygotowanie inwestycji do sprzedaży, budowanie zespołów sprzedażowych i kompleksowe zarządzanie procesem.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div id="main-news">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-head text-center">
                        <h6 class="sub-title">Co u nas?</h6>
                        <h2 class="title">Ostatnie aktualności</h2>
                    </div>
                </div>
                @foreach ($articles as $n)
                    <article class="col-4" id="list-post-{{ $n->id }}" itemscope="" itemtype="http://schema.org/NewsArticle">
                        <div class="list-post">
                            <div class="list-post-thumb">
                                <a href="{{route('front.news.show', $n->slug)}}" title="{{ $n->title }}" itemprop="url"><img src="{{asset('uploads/articles/thumbs/'.$n->file) }}" alt="{{ $n->title }}"></a>
                            </div>
                            <div class="list-post-content">
                                <header>
                                    @if($n->date)<div class="list-post-date text-muted">Data publikacji: <span itemprop="datePublished" content="{{ $n->date }}">{{ $n->date }}</span></div>@endif
                                    <h5 class="title"><a href="{{route('front.news.show', $n->slug)}}" itemprop="url"><span itemprop="name headline">{{ $n->title }}</span></a></h5>
                                </header>

                                <div class="list-post-entry" itemprop="articleBody">
                                    <p class="small-text">{{ $n->content_entry }}</p>
                                </div>

                                <footer>
                                    <a itemprop="url" href="{{route('front.news.show', $n->slug)}}" title="{{ $n->title }}" class="bttn bttn-sm">Czytaj więcej</a>
                                    <meta itemprop="author" content="DeveloPro">
                                    <meta itemprop="mainEntityOfPage" content="">
                                </footer>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>


@include('layouts.partials.footer')

@include('layouts.partials.cookies')

<!-- jQuery -->
<script src="{{ asset('/js/jquery.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/app.js') }}" charset="utf-8"></script>

@stack('scripts')

<script type="text/javascript">
    $(document).ready(function(){
        $("#slider ul").responsiveSlides({auto:true, pager:false, nav:true, timeout:4000, random:false, speed:500});
    });
    $(window).load(function() {
        $("#slider ul").show();
        $(".rslides_nav").show();
    });
</script>

</body>
</html>
