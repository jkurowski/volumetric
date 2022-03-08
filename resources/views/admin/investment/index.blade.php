@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-6 pl-0">
                        <h4 class="page-title"><i class="fe-home"></i>Przeglądaj inwestycje</h4>
                    </div>
                    <div class="col-6 d-flex justify-content-end align-items-center form-group-submit">
                        <a href="{{route('admin.developro.create')}}" class="btn btn-primary">Dodaj inwestycje</a>
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
                        <th>Data modyfikacji</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="content">
                    @foreach ($list as $index => $p)
                        <tr id="recordsArray_{{ $p->id }}">
                            <th class="position" scope="row">{{ $index+1 }}</th>
                            <td>{{ $p->name }}</td>
                            <td><span class="badge inwest-list-status-{{ $p->status }}">{{ investmentStatus($p->status) }}</span></td>
                            <td>{{ $p->updated_at }}</td>
                            <td class="option-120">
                                <div class="btn-group">
                                    <a href="{{route('admin.developro.edit', $p->id)}}" class="btn action-button me-1" data-toggle="tooltip" data-placement="top" title="Edytuj"><i class="fe-edit"></i></a>
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
