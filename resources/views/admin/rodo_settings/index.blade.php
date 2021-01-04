@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-12 pl-0">
                        <h4 class="page-title row"><i class="fe-inbox"></i>RODO: ustawienia</h4>
                    </div>
                </div>
            </div>

            <div class="card-header border-bottom card-nav">
                <nav class="nav">
                    <a class="nav-link {{ Request::routeIs('admin.inbox.index') ? 'active' : '' }}" href="{{ route('admin.inbox.index') }}"><span class="fe-list"></span> Lista wiadomości</a>
                    <a class="nav-link {{ Request::routeIs('admin.rodo.rules.index') ? 'active' : '' }}" href="{{ route('admin.rodo.rules.index') }}"><span class="fe-check-square"></span> RODO: regułki</a>
                    <a class="nav-link" href="{{ route('admin.rodo.clients.index') }}"><span class="fe-users"></span> RODO: użytkownicy</a>
                    <a class="nav-link {{ Request::routeIs('admin.rodo.settings.index') ? 'active' : '' }}" href="{{ route('admin.rodo.settings.index') }}"><span class="fe-settings"></span> RODO: ustawienia</a>
                </nav>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body card-body-rem p-0">
                <div class="table-overflow">
                    @if (session('success'))
                        <div class="alert alert-success border-0 mb-0">
                            {{ session('success') }}
                            <script>setTimeout(function(){$(".alert").slideUp(500,function(){$(this).remove()})},3000)</script>
                        </div>
                    @endif
                    <form method="POST" action="{{route('admin.rodo.settings.update', 1)}}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                        <div class="container-fluid p-0">
                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-12">
                                            @include('form-elements.textarea-fullwidth', ['label' => 'Obowiązek informacyjny', 'name' => 'obligation', 'value' => $entry->obligation, 'rows' => 11])
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
