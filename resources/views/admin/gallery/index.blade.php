@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-6 pl-0">
                        <h4 class="page-title row"><i class="fe-image"></i>Galeria</h4>
                    </div>
                    <div class="col-6 d-flex justify-content-end align-items-center form-group-submit">
                        <a href="{{route('admin.gallery.create')}}" class="btn btn-primary">Dodaj galerię</a>
                    </div>
                </div>
            </div>
            <div class="table-overflow">
                <table id="sortable" class="table mb-0">
                    <thead class="thead-default">
                    <tr>
                        <th>Nazwa</th>
                        <th>Opis</th>
                        <th class="text-center">Ilość zdjęć</th>
                        <th>Data modyfikacji</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="content">
                    @foreach ($list as $p)
                        <tr id="recordsArray_{{ $p->id }}">
                            <td><a href="{{ route('admin.gallery.show', $p) }}">{{ $p->name }}</a></td>
                            <td>@if($p->text){{ $p->text }}@endif</td>
                            <td class="text-center">{{ $p->photos->count() }}</td>
                            <td>{{ $p->updated_at }}</td>
                            <td class="option-120"></td>
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
                    <a href="{{route('admin.gallery.create')}}" class="btn btn-primary">Dodaj galerię</a>
                </div>
            </div>
        </div>
    </div>
@endsection
