@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-12 pl-0">
                        <h4 class="page-title row"><i class="fe-inbox"></i>Wiadomości</h4>
                    </div>
                </div>
            </div>

            <div class="card-header border-bottom card-nav">
                <nav class="nav">
                    <a class="nav-link {{ Request::routeIs('admin.inbox.index') ? ' active' : '' }}" href="{{ route('admin.inbox.index') }}"><span class="fe-list"></span> Lista wiadomości</a>
                    <a class="nav-link {{ Request::routeIs('admin.rodo.rules') ? ' active' : '' }}" href="{{ route('admin.rodo.rules') }}"><span class="fe-check-square"></span> RODO: regułki</a>
                    <a class="nav-link" href=""><span class="fe-users"></span> RODO: użytkownicy</a>
                    <a class="nav-link" href=""><span class="fe-settings"></span> RODO: ustawienia</a>
                </nav>
            </div>

        </div>
        <div class="card mt-3">
            <div class="card-body card-body-rem p-0">
                <div class="table-overflow">
                    <table class="table mb-0" id="sortable">
                        <thead class="thead-default">
                        <tr>
                            <th>#</th>
                            <th>Nazwa</th>
                            <th class="text-center">Czas trwania</th>
                            <th class="text-center">Wymagane</th>
                            <th class="text-center">Status</th>
                            <th>Data utworzenia</th>
                            <th>Data edycji</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="content">
                        @foreach ($list as $index => $p)
                            <tr>
                                <th class="position" scope="row">{{ $index+1 }}</th>
                                <td>{{ $p->title }}</td>
                                <td class="text-center">{{ $p->time }}</td>
                                <td class="text-center">{!! required($p->required) !!}</td>
                                <td class="text-center">{!! status($p->status) !!} </td>
                                <td>{{ $p->created_at }}</td>
                                <td>{{ $p->updated_at }}</td>
                                <td class="option-120">
                                    <div class="btn-group">
                                        <a href="" class="btn action-button mr-1" data-toggle="tooltip" data-placement="top" title="Edytuj"><i class="fe-edit"></i></a>
                                        <form method="POST" action="">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn action-button confirm" data-toggle="tooltip" data-placement="top" title="Usuń wiadomość" data-id="{{ $p->id }}"><i class="fe-trash-2"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
