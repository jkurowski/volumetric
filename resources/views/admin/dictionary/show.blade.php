@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-6 pl-0">
                        <h4 class="page-title"><i class="fe-book-open"></i><a href="{{route('admin.dictionary.index')}}">Przeglądaj słownik</a><span class="d-inline-flex me-2 ms-2">/</span>{{ $available_locales[$current_locale] }}</h4>
                    </div>
                </div>
            </div>
            <div class="card-header border-bottom card-nav">
                <nav class="nav">
                    <a class="nav-link" href="{{route('admin.dictionary.index')}}"><span class="fe-folder"></span> Lista słowników</a>
                </nav>
            </div>
            <div class="card mt-3">
                <div class="card-body card-body-rem p-0">
                    <div class="table-overflow">
                        <table class="table mb-0">
                            <thead class="thead-default">
                            <tr>
                                <th>Tag</th>
                                <th>Tłumaczenie</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="content">
                            @foreach (Lang::get('cms') as $slug => $translate)
                                <tr>
                                    <td>{{ $slug }}</td>
                                    <td>{{ $translate }}</td>
                                    <td class="option-120">
                                        <div class="btn-group">
                                            <a href="{{route('admin.dictionary.edit', ['slug' => $slug, 'locale' => $locale])}}" class="btn action-button me-1" data-toggle="tooltip" data-placement="top" title="Edytuj wpis"><i class="fe-edit"></i></a>
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
    </div>
@endsection



