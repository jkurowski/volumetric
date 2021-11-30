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
                <div id="jqalert"></div>
                @if (session('success'))
                    <div class="alert alert-success border-0 mb-0">
                        {{ session('success') }}
                        <script>setTimeout(function(){$(".alert").slideUp(500,function(){$(this).remove()})},3000)</script>
                    </div>
                @endif
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
                            <td class="option-120">
                                <div class="btn-group">
                                    <span class="btn action-button move-button me-1"><i class="fe-move"></i></span>
                                    <a href="{{route('admin.gallery.edit', $p->id)}}" class="btn action-button me-1" data-toggle="tooltip" data-placement="top" title="Edytuj wpis"><i class="fe-edit"></i></a>
                                    <form method="POST" action="{{route('admin.gallery.destroy', $p->id)}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button
                                            type="submit"
                                            class="btn action-button confirm"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Usuń wpis"
                                            data-id="{{ $p->id }}"
                                        ><i class="fe-trash-2"></i></button>
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
                    <a href="{{route('admin.gallery.create')}}" class="btn btn-primary">Dodaj galerię</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" language="javascript">
        //<![CDATA[
        $(document).ready(function(){
            $("#sortable tbody.content").sortuj('{{route('admin.gallery.sort')}}');
        });
        //]]>
    </script>
@endpush
