@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-12 pl-0">
                        <h4 class="page-title row"><i class="fe-sliders"></i>Ustawienia</h4>
                    </div>
                </div>
            </div>

            <div class="card-header border-bottom card-nav">
                <nav class="nav">
                    <a class="nav-link {{ Request::routeIs('admin.dashboard.seo.index') ? 'active' : '' }}" href="{{ route('admin.dashboard.seo.index') }}"><span class="fe-globe"></span> Główne ustawienia</a>
                    <a class="nav-link {{ Request::routeIs('admin.dashboard.social.index') ? ' active' : '' }}" href="{{ route('admin.dashboard.social.index') }}"><span class="fe-hash"></span> Social Media</a>
                    <a class="nav-link {{ Request::routeIs('admin.logs.*') ? 'active' : '' }}" href="{{route('admin.logs.index')}}"><span class="fe-hard-drive"></span> Logi PA</a>
                    <a class="nav-link {{ Request::routeIs('admin.tracker.errors') ? 'active' : '' }}" href="{{route('admin.tracker.errors')}}"><span class="fe-alert-circle"></span> Błędy</a>
                </nav>
            </div>

        </div>
        <div class="card mt-3">
            <div class="card-body card-body-rem p-0">
                <div class="table-overflow">
                    @yield('dashboard')
                </div>
            </div>
        </div>
    </div>
@endsection
