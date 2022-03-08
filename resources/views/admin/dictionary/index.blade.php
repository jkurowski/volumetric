@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-6 pl-0">
                        <h4 class="page-title"><i class="fe-book-open"></i>Przeglądaj słownik</h4>
                    </div>
                </div>
            </div>
            <div class="table-overflow">
                <table class="table mb-0">
                    <thead class="thead-default">
                    <tr>
                        <th>Język</th>
                        <th>Tag</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="content">
                    @foreach($available_locales as $available_locale => $locale_name)
                        <tr>
                            <td>{{ $locale_name }}</td>
                            <td>{{ $available_locale }}</td>
                            <td class="option-120">
                                <div class="btn-group">
                                    <a href="{{route('admin.dictionary.show', $available_locale)}}" class="btn action-button me-1" data-toggle="tooltip" data-placement="top" title="Pokaż słownik"><i class="fe-folder"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection



