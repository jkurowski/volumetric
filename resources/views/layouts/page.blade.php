<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('seo_title')@yield('seo_title')@else{{ 'Naza z ustawienia' }} - @yield('meta_title')@endif</title>

    <meta name="description" content="@hasSection('seo_description')@yield('seo_description')@else{{ 'opis z ustawienia'}}@endif">
    <meta name="robots" content="@hasSection('seo_robots')@yield('seo_robots')@else{{ 'indeksowanie z ustawienia'}}@endif">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">

    @stack('style')
</head>
<body class="{{ !empty($body_class) ? $body_class : '' }}">
<div class="page-header">
    @include('layouts.header')

    @yield('pagheader')
</div>
<div id="page">
    @yield('content')
</div>
@include('layouts.footer')

@include('layouts.cookies')

<!-- jQuery -->
<script src="/js/jquery.min.js" charset="utf-8"></script>
<script src="/js/app.js" charset="utf-8"></script>

@stack('scripts')

<script type="text/javascript">
    $(document).ready(function(){

    });
</script>
<!-- Google fonts -->
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;400;600;700&display=swap" rel="stylesheet">

<!-- jQuery -->
</body>
</html>
