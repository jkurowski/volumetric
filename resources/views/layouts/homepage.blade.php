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
@if($investments->count() > 0)
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
        @if($investments->count() > 1)
        <div class="row">
            <div class="col-12">
                <ul class="mb-0 list-unstyled invest-list-nav">
                    @foreach($investments as $investment)
                    <li>{{ $investment->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </div>

    <div class="container invest-list-carousel">
        @foreach($investments as $investment)
        <div class="row invest-list-item @if($investments->count() == 1) mt-4 @endif">
            <div class="col-6">
                <a href="{{ $investment->url }}" target="_blank"><img src="{{ asset('/uploads/investments/thumbs/'.$investment->file_thumb) }}" alt="{{ $investment->city }} - {{ $investment->name }}"></a>
            </div>
            <div class="col-3 d-flex align-items-center justify-content-center">
                <div class="invest-list-desc text-center">
                    <h3>{{ $investment->name }}</h3>
                    <ul class="mb-0 list-unstyled">
                        @if($investment->deadline)<li class="text-uppercase">@lang('cms.deadline-date'): {{ $investment->deadline }}</li>@endif
                        <li class="text-uppercase">{{ $investment->city }} | {{ $investment->address }}</li>
                        @if($investment->entry_content)<li>{{ $investment->entry_content }}</li>@endif
                    </ul>
                    @if($investment->url)<a href="{{ $investment->url }}" class="bttn" target="_blank">@lang('cms.slider-button')</a>@endif
                </div>
            </div>
            <div class="col-3">
                <a href="{{ $investment->url }}" target="_blank"><img src="{{ asset('/uploads/investments/carousel/'.$investment->file_carousel) }}" alt="{{ $investment->city }} - {{ $investment->name }}"></a>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif
<section>
    <div class="container">
        <div class="row position-relative">
            <div class="col-12 col-lg-6" data-aos="fade-right" data-aos-offset="300">
                <img src="{{asset('images/dlaczego-my.jpg') }}" alt="@lang('cms.whyusbox-subtitle')">
            </div>
            <div class="col-12 col-lg-7 offset-0 offset-lg-5 position-absolute pl-0 offset-absolute d-flex align-items-center" data-aos="fade-left" data-aos-offset="300">
                <div class="offset-apla">
                    <div class="section-header text-center">
                        <span>@lang('cms.whyusbox-title')</span>
                        <h2>@lang('cms.whyusbox-subtitle')</h2>
                    </div>
                    <ul class="mb-0 list-unstyled">
                        <li class="inline inline-tc">
                            <svg viewBox="0 0 92.655 92.655" xmlns="http://www.w3.org/2000/svg"><g transform="translate(-929 -3884)"><g transform="translate(959.62 3910)"><path transform="translate(-.055)" d="M30.568,8.036,15.651.087a.741.741,0,0,0-.706,0L.44,8.04a.743.743,0,0,0-.385.651V19.075A21.5,21.5,0,0,0,12.941,38.75l2.013.877a.742.742,0,0,0,.591,0l2.269-.98a21.456,21.456,0,0,0,13.148-19.78V8.692a.743.743,0,0,0-.393-.656ZM29.476,18.868A19.974,19.974,0,0,1,17.232,37.282l0,0-1.976.853-1.717-.749a20.012,20.012,0,0,1-12-18.315V9.131L15.306,1.586l14.17,7.55Zm0,0"/><path transform="translate(-71.377 -130.55)" d="M81.149,149.139a.743.743,0,0,0-1.13.964l3.923,4.594a.742.742,0,0,0,1.033.094l9.136-7.433a.743.743,0,1,0-.937-1.152L84.6,153.181Zm0,0"/></g><g transform="translate(929 3930.3) rotate(-45)" fill="none" stroke="#000" stroke-width="2"><rect width="65.517" height="65.517" stroke="none"/><rect x="1" y="1" width="63.517" height="63.517" fill="none"/></g></g></svg>

                            <h3 data-modaltytul="7">{{ getInline($array, 7, 'modaltytul') }}</h3>
                            <p data-modaleditor="7">{{ getInline($array, 7, 'modaleditor') }}</p>

                            <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="7" data-hideinput="modaleditortext,modallink,modallinkbutton,file,file_alt" data-method="update" data-imgwidth="796" data-imgheight="738"></button></div>
                        </li>
                        <li class="inline inline-tc">
                            <svg xmlns="http://www.w3.org/2000/svg" width="91.212" height="91.212" viewBox="0 0 91.212 91.212"> <g id="Group_79" transform="translate(-929 -4019)"> <g id="Rectangle_12" transform="translate(929 4064.606) rotate(-45)" fill="none" stroke="#000" stroke-width="2"> <rect width="64.497" height="64.497" stroke="none"/> <rect x="1" y="1" width="62.497" height="62.497" fill="none"/> </g> <g id="najwyzsza-jakosc" transform="translate(959.769 4047)"> <g id="Group_7" transform="translate(0)"> <g id="Group_6"> <path id="Path_16" d="M69.475,31.082l-3.754-4.826a5.433,5.433,0,0,0,2.97-2.2c.884-1.528.484-3.393.1-5.194a14.187,14.187,0,0,1-.418-2.825,14.182,14.182,0,0,1,.418-2.828c.384-1.8.786-3.666-.1-5.191-.915-1.582-2.759-2.167-4.541-2.732a13.211,13.211,0,0,1-2.564-1,12.531,12.531,0,0,1-2.055-1.666C58.208,1.39,56.709,0,54.8,0s-3.408,1.39-4.731,2.617a12.535,12.535,0,0,1-2.054,1.666,13.207,13.207,0,0,1-2.564,1c-1.783.565-3.626,1.15-4.541,2.732-.884,1.528-.484,3.393-.1,5.194a14.182,14.182,0,0,1,.417,2.828,14.182,14.182,0,0,1-.418,2.828c-.384,1.8-.786,3.666.1,5.191a5.433,5.433,0,0,0,2.973,2.2l-3.757,4.826a.617.617,0,0,0,.564.991l4.411-.551,1.089,3.81a.617.617,0,0,0,.476.436.629.629,0,0,0,.117.011.617.617,0,0,0,.487-.238l3.939-5.067a5.7,5.7,0,0,0,3.593,1.6,5.7,5.7,0,0,0,3.593-1.6l3.939,5.065a.617.617,0,0,0,.487.24.629.629,0,0,0,.117-.011.617.617,0,0,0,.476-.436L64.5,31.521l4.411.551a.617.617,0,0,0,.564-.991ZM47.04,33.823l-.9-3.15a.617.617,0,0,0-.669-.442l-3.454.432,3.1-3.98.341.109a13.207,13.207,0,0,1,2.561,1,12.531,12.531,0,0,1,2.055,1.666l.212.2Zm7.76-2.98c-1.425,0-2.623-1.11-3.893-2.287a13.6,13.6,0,0,0-2.276-1.83,14.3,14.3,0,0,0-2.809-1.11c-1.63-.518-3.171-1.006-3.847-2.174-.645-1.116-.312-2.671.041-4.318a15.1,15.1,0,0,0,.445-3.084,15.1,15.1,0,0,0-.445-3.084c-.353-1.646-.687-3.2-.041-4.318.679-1.168,2.216-1.657,3.847-2.174a14.307,14.307,0,0,0,2.808-1.11,13.6,13.6,0,0,0,2.275-1.83c1.27-1.177,2.469-2.287,3.894-2.287s2.623,1.11,3.893,2.287a13.6,13.6,0,0,0,2.276,1.83,14.3,14.3,0,0,0,2.809,1.11c1.63.518,3.171,1.006,3.847,2.174.645,1.116.312,2.671-.041,4.318a15.1,15.1,0,0,0-.445,3.084,15.1,15.1,0,0,0,.445,3.084c.353,1.646.687,3.2.041,4.318-.679,1.168-2.216,1.657-3.847,2.174a14.308,14.308,0,0,0-2.808,1.11,13.6,13.6,0,0,0-2.275,1.83C57.424,29.732,56.225,30.843,54.8,30.843Zm9.332-.612a.617.617,0,0,0-.669.442l-.9,3.15-3.241-4.167.212-.2a12.534,12.534,0,0,1,2.054-1.666,13.207,13.207,0,0,1,2.564-1l.341-.109,3.1,3.98Z" transform="translate(-39.995)"/> </g> </g> <g id="Group_9"  transform="translate(3.701 4.935)"> <g id="Group_8" transform="translate(0)"> <path id="Path_17" d="M99.1,64a11.1,11.1,0,1,0,11.1,11.1A11.1,11.1,0,0,0,99.1,64Zm0,20.973a9.87,9.87,0,1,1,9.87-9.87A9.87,9.87,0,0,1,99.1,84.973Z" transform="translate(-88 -64)"/> </g> </g> <g id="Group_11" transform="translate(7.45 8.511)"> <g id="Group_10" transform="translate(0)"> <path id="Path_18" d="M151.088,115.327a1.233,1.233,0,0,0-1-.508h-3.776l-1.172-3.594a1.234,1.234,0,0,0-2.344,0l-1.169,3.594H137.85a1.234,1.234,0,0,0-.727,2.231l3.057,2.221-1.168,3.594a1.234,1.234,0,0,0,1.9,1.379l3.059-2.22,3.058,2.221a1.234,1.234,0,0,0,1.9-1.379l-1.168-3.6,3.057-2.221A1.234,1.234,0,0,0,151.088,115.327Zm-4.417,3.21a.617.617,0,0,0-.224.69l1.307,4.021-3.42-2.485a.617.617,0,0,0-.725,0l-3.42,2.485,1.306-4.021a.617.617,0,0,0-.224-.69l-3.42-2.485h4.227a.617.617,0,0,0,.587-.426l1.307-4.021,1.306,4.02a.617.617,0,0,0,.587.426h4.227Z" transform="translate(-136.616 -110.376)"/> </g> </g> </g> </g></svg>

                            <h3 data-modaltytul="8">{{ getInline($array, 8, 'modaltytul') }}</h3>
                            <p data-modaleditor="8">{{ getInline($array, 8, 'modaleditor') }}</p>

                            <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="8" data-hideinput="modaleditortext,modallink,modallinkbutton,file,file_alt" data-method="update" data-imgwidth="796" data-imgheight="738"></button></div>
                        </li>
                        <li class="inline inline-tc">
                            <svg xmlns="http://www.w3.org/2000/svg" width="91.212" height="91.212" viewBox="0 0 91.212 91.212"> <g id="Group_80" transform="translate(-929 -4152.557)"> <g id="Rectangle_10" transform="translate(929 4198.163) rotate(-45)" fill="none" stroke="#000" stroke-width="2"> <rect width="64.497" height="64.497" stroke="none"/> <rect x="1" y="1" width="62.497" height="62.497" fill="none"/> </g> <g id="realizacja" transform="translate(955.749 4179.557)"> <g id="Group_5" transform="translate(0)"> <g id="Group_4"> <path id="Path_7" d="M176.82,42.05a.822.822,0,0,0,.82-.82v-.41a.82.82,0,1,0-1.64,0v.41A.822.822,0,0,0,176.82,42.05Z" transform="translate(-157.963 -35.901)"/> <path id="Path_8"  d="M176.82,308a.822.822,0,0,0-.82.82v.41a.82.82,0,1,0,1.64,0v-.41A.822.822,0,0,0,176.82,308Z" transform="translate(-157.963 -276.435)"/> <path id="Path_9"  d="M41.23,176h-.41a.82.82,0,1,0,0,1.64h.41a.82.82,0,1,0,0-1.64Z" transform="translate(-35.901 -157.963)"/> <path id="Path_10" d="M309.23,176h-.41a.82.82,0,1,0,0,1.64h.41a.82.82,0,0,0,0-1.64Z" transform="translate(-276.435 -157.963)"/> <path id="Path_11" d="M81.394,80.246a.812.812,0,0,0-1.148,1.148l.287.287a.793.793,0,0,0,1.148,0,.793.793,0,0,0,0-1.148Z" transform="translate(-71.801 -71.801)"/> <path id="Path_12" d="M80.533,269.446l-.287.287a.793.793,0,0,0,0,1.148.793.793,0,0,0,1.148,0l.287-.287a.812.812,0,1,0-1.148-1.148Z" transform="translate(-71.801 -241.611)"/> <path id="Path_13" d="M269.733,80.246l-.287.287a.793.793,0,0,0,0,1.148.792.792,0,0,0,1.148,0l.287-.287a.812.812,0,0,0-1.148-1.148Z" transform="translate(-241.611 -71.801)"/> <path id="Path_14" d="M177.64,108.281V100.82a.82.82,0,0,0-1.64,0v7.789a.809.809,0,0,0,.246.574l8.978,8.978a.793.793,0,0,0,1.148,0,.793.793,0,0,0,0-1.148Z" transform="translate(-157.963 -89.751)"/> <path id="Path_15" d="M18.857,0A18.857,18.857,0,1,0,37.715,18.857,18.86,18.86,0,0,0,18.857,0Zm0,36.075A17.218,17.218,0,1,1,36.075,18.857,17.215,17.215,0,0,1,18.857,36.075Z" transform="translate(0)"/> </g> </g> </g> </g></svg>
                            <h3 data-modaltytul="9">{{ getInline($array, 9, 'modaltytul') }}</h3>
                            <p data-modaleditor="9">{{ getInline($array, 9, 'modaleditor') }}</p>

                            <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="9" data-hideinput="modaleditortext,modallink,modallinkbutton,file,file_alt" data-method="update" data-imgwidth="796" data-imgheight="738"></button></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@if($gallery->photos->count() > 0)
<section id="maincarousel">
    <div class="container">
        <div class="row">
            @php $i = 0 @endphp
            @foreach($gallery->photos as $p)
                @if($i == 0 || $i == 1)
                <div class="col-3">
                @endif
                    @if($i == 0)
                        <a href="/uploads/gallery/images/{{$p->file}}" class="swipebox"><img src="/uploads/gallery/images/thumbs/{{$p->file}}" alt="{{ $p->name }}"></a>
                    @else
                        <a href="/uploads/gallery/images/{{$p->file}}" class="swipebox"><img src="/uploads/gallery/images/thumbs2/{{$p->file}}" alt="{{ $p->name }}"></a>
                    @endif
                @if($i == 0 || $i == 2)
                </div>
                @endif
                @php $i++ @endphp
                @if($i == 3) @php $i = 0 @endphp @endif
            @endforeach
        </div>
    </div>
</section>
@endif
<section>
    <div class="container">
        <div class="row flex-row-reverse position-relative inline inline-tc">
            <div class="col-12 col-lg-6" data-aos="fade-left" data-aos-offset="0" data-aos-delay="700">
                <img src="{{ getInline($array, 6, 'file') }}" alt="{{ getInline($array, 6, 'file_alt') }}" data-img="6">
            </div>
            <div class="col-12 col-lg-7 position-absolute pr-3 pr-lg-0 offset-absolute d-flex align-items-center" data-aos="fade-right" data-aos-offset="0" data-aos-delay="700">
                <div class="offset-apla">
                    <div class="section-header text-center">
                        <span data-modaleditor="6">{{ getInline($array, 6, 'modaleditor') }}</span>
                        <h2 data-modaltytul="6">{{ getInline($array, 6, 'modaltytul') }}</h2>
                    </div>
                    <div data-modaleditortext="6">{!! getInline($array, 6, 'modaleditortext') !!}</div>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('investment.index') }}" class="bttn">@lang('cms.goformore-button')</a>
                    </div>
                </div>
            </div>
            <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="6" data-hideinput="modallink,modallinkbutton" data-method="update" data-imgwidth="796" data-imgheight="738"></button></div>
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
                                        <li><span class="square-icon"><img src="{{asset('svg/phone-icon.svg') }}" class="phone-svg-icon" alt="Numer telefonu"></span><a href="tel:664130140">664 130 140</a></li>
                                        <li><span class="square-icon"><img src="{{asset('svg/phone-icon.svg') }}" class="phone-svg-icon" alt="Numer telefonu"></span><a href="tel:226543838">22 654 38 38</a></li>
                                        <li><span class="square-icon"><img src="{{asset('svg/envelope-icon.svg') }}" class="envelope-svg-icon" alt="Numer telefonu"></span><a href="mailto:biuro@volumetric.pl">biuro@volumetric.pl</a></li>
                                    </ul>

                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('contact.index') }}" class="bttn">@lang('cms.gotoform-button')</a>
                                    </div>
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

@include('layouts.partials.footer')

@include('layouts.partials.cookies')

<!-- jQuery -->
<script src="{{ asset('/js/jquery.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/bootstrap.bundle.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/slick.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/app.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/aos.min.js') }}" charset="utf-8"></script>

@include('layouts.partials.inline')

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
        AOS.init();
    });
    $(window).load(function() {
        $("#slider ul").show();
        $(".rslides_nav").show();
    });
</script>

</body>
</html>
