@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-12 pl-0">
                        <h4 class="page-title row"><i class="fe-settings"></i>Panel administratora</h4>
                    </div>
                </div>
            </div>

            <div class="card-header border-bottom card-nav">
                <nav class="nav">
                    <a class="nav-link" href=""><span class="fe-settings"></span> Panel administratora</a>
                    <a class="nav-link" href="{{ route('admin.dashboard.seo.index') }}"><span class="fe-globe"></span> SEO</a>
                    <a class="nav-link" href="{{ route('admin.dashboard.social.index') }}"><span class="fe-hash"></span> Social Media</a>
                </nav>
            </div>

        </div>
        <div class="card mt-3">
            <div class="card-body card-body-rem p-0">
                <div class="table-overflow">
                    1
                </div>
            </div>
        </div>
    </div>
@endsection
