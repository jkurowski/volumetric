<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>DeveloPro @yield('meta_title')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="robots" content="noindex, nofollow">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Prefetch -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
</head>
<body class="lang-pl">
<div id="admin">
    <div class="sidemenu-holder">
        <div id="sidemenu">
            <ul class="list-unstyled mb0">
                <!--
                <li class="">
                    <a href="{{route('admin.dashboard.seo.index')}}">
                        <i class="fe-sliders"></i>
                        <span> Ustawienia </span>
                    </a>
                </li>
                <li class="{{ Request::routeIs('admin.user.*') ? 'active' : '' }}">
                    <a href="{{route('admin.user.index')}}">
                        <i class="fe-users"></i>
                        <span> Użytkownicy </span>
                    </a>
                </li>

                <li class="{{ Request::routeIs('admin.page.*') ? 'active' : '' }}">
                    <a href="{{route('admin.page.index')}}">
                        <i class="fe-file-text"></i>
                        <span> Menu </span>
                    </a>
                </li>
                -->
                <li class="{{ Request::routeIs('admin.map.*') ? 'active' : '' }}">
                    <a href="{{route('admin.map.index')}}">
                        <i class="fe-map-pin"></i>
                        <span> Mapa </span>
                    </a>
                </li>
                <li class="{{ Request::routeIs('admin.greylist.*') ? 'active' : '' }}">
                    <a href="{{route('admin.greylist.index')}}">
                        <i class="fe-shield"></i>
                        <span> Blokada dostępu </span>
                    </a>
                </li>
                <li class="{{ Request::routeIs('admin.gallery.*') ? 'active' : '' }}">
                    <a href="{{route('admin.gallery.index')}}">
                        <i class="fe-image"></i>
                        <span> Galeria </span>
                    </a>
                </li>
                <li class="{{ Request::routeIs('admin.article.*') ? 'active' : '' }}">
                    <a href="{{route('admin.article.index')}}">
                        <i class="fe-book-open"></i>
                        <span> Aktualności </span>
                    </a>
                </li>
                <li class="{{ Request::routeIs('admin.slider.*') ? 'active' : '' }}">
                    <a href="{{route('admin.slider.index')}}">
                        <i class="fe-airplay"></i>
                        <span> Slider </span>
                    </a>
                </li>
                <li class="{{ Request::routeIs('admin.box.*') ? 'active' : '' }}">
                    <a href="{{route('admin.box.index')}}">
                        <i class="fe-grid"></i>
                        <span> Boksy </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>

    <div id="content">
        <header id="header-navbar">
            <h1><a href="" class="logo"><span>kCMS v4.3</span></a></h1>

            <a href="#" id="togglemenu"><span class="fe-menu"></span></a>

            <div class="user">
                <ul>
                    <li><span class="fe-calendar"></span> <span id="livedate"><?=date('d-m-Y');?></span></li>
                    <li><span class="fe-clock"></span> <span id="liveclock"></span></li>
                    <li><span class="fe-user"></span> Witaj: <b>{{ Auth::user()->name }}</b></li>
                    <li><a title="Idź do strony" href="{{ route('index') }}" target="_blank"><span class="fe-monitor"></span> Idź do strony</a></li>
                    <li>
                        <a title="Wyloguj" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span class="fe-lock"></span> Wyloguj</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </header>
        <div class="content">
            @yield('submenu')

            @yield('content')
        </div>
    </div>
</div>

<!--Google font style-->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- jQuery -->
<script src="{{ asset('/js/jquery.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/bootstrap.bundle.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/jquery-ui.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/cms.js') }}" charset="utf-8"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    @if(count($errors) > 0)
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.error("Formularz zawiera błędy");
    @endif
    @if(Session::has('success'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.success("{{ session('success') }}");
    @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.error("{{ session('error') }}");
    @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.info("{{ session('info') }}");
    @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.warning("{{ session('warning') }}");
    @endif
</script>
@stack('scripts')

</body>
</html>
