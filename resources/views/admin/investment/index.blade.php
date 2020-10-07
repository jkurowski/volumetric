@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-6 pl-0">
                        <h4 class="page-title row"><i class="fe-home"></i>Przeglądaj inwestycje</h4>
                    </div>
                    <div class="col-6 d-flex align-items-center justify-content-center">
                        @if (session('success'))
                            <div class="alert alert-success border-0 mb-0 w-100 text-center">
                                {{ session('success') }}
                                <script>window.setTimeout(function(){$(".alert").fadeTo(500,0).slideUp(500,function(){$(this).remove()})},3000);</script>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="table-overflow">
                <table class="table mb-0" id="sortable">
                    <thead class="thead-default">
                    <tr>
                        <th>#</th>
                        <th>Nazwa</th>
                        <th class="text-center">Status</th>
                        <th>Typ</th>
                        <th>Data modyfikacji</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="content">
                    @foreach ($list as $index => $p)
                        <tr id="recordsArray_{{ $p->id }}">
                            <th class="position" scope="row">{{ $index+1 }}</th>
                            <td>
                                @if ($p->type == 1)
                                    <a href="{{route('admin.developro.building.index', $p->id)}}">{{ $p->name }}</a>
                                @endif
                                @if ($p->type == 2)
                                    <a href="{{route('admin.developro.floor.index', $p->id)}}">{{ $p->name }}</a>
                                @endif
                                @if ($p->type == 3)
                                    <a href="{{route('admin.developro.house.index', $p->id)}}">{{ $p->name }}</a>
                                @endif
                            </td>
                            <td><span class="badge inwest-list-status-{{ $p->status }}">{{ investmentStatus($p->status) }}</span></td>
                            <td>{{ investmentType($p->type) }}</td>
                            <td>{{ $p->updated_at }}</td>
                            <td class="option-120">
                                <div class="btn-group">
                                    <a href="{{route('admin.developro.plan.index', $p->id)}}" class="btn action-button mr-1" data-toggle="tooltip" data-placement="top" title="Plan inwestycji"><i class="fe-image"></i></a>
                                    @if ($p->type == 1)
                                        <a href="{{route('admin.developro.building.index', $p->id)}}" class="btn action-button mr-1" data-toggle="tooltip" data-placement="top" title="Lista budynków"><i class="fe-grid"></i></a>
                                    @endif
                                    @if ($p->type == 2)
                                        <a href="{{route('admin.developro.floor.index', $p->id)}}" class="btn action-button mr-1" data-toggle="tooltip" data-placement="top" title="Lista kondygnacji"><i class="fe-layers"></i></a>
                                    @endif
                                    @if ($p->type == 3)
                                        <a href="{{route('admin.developro.house.index', $p->id)}}" class="btn action-button mr-1" data-toggle="tooltip" data-placement="top" title="Lista domów"><i class="fe-archive"></i></a>
                                    @endif

                                    <a href="{{route('admin.developro.edit', $p->id)}}" class="btn action-button mr-1" data-toggle="tooltip" data-placement="top" title="Edytuj"><i class="fe-edit"></i></a>
                                    <form method="POST" action="{{route('admin.developro.destroy', $p->id)}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn action-button confirm" data-toggle="tooltip" data-placement="top" title="Usuń wpis" data-id="{{ $p->id }}"><i class="fe-trash-2"></i></button>
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
    <div class="form-group form-group-submit">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <a href="{{route('admin.developro.create')}}" class="btn btn-primary">Dodaj inwestycje</a>
                </div>
            </div>
        </div>
    </div>
@endsection
