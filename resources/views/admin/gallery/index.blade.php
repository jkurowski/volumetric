@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
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
@endsection
