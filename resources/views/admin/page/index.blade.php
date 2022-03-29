@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="table-overflow">
                @if (session('success'))
                    <div class="alert alert-success border-0 mb-0">
                        {{ session('success') }}
                        <script>setTimeout(function(){$(".alert").slideUp(500,function(){$(this).remove()})},3000)</script>
                    </div>
                @endif
                <table class="table mb-0">
                    <thead class="thead-default">
                    <tr>
                        <th>Nazwa</th>
                        <th>Nagłówek</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Typ</th>
                        <th>Ścieżka</th>
                        <th class="text-center">Data utworzenia</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="content">
                        @foreach($list as $page)
                            <tr>
                                <td>{{$page->title}}</td>
                                <td>@if($page->file)<img src="/uploads/pages/headers/{{ $page->file }}" alt="{{ $page->title }}" style="border-radius: 5px;width: 330px">@endif</td>
                                <td class="text-center">{!! status($page->active) !!}</td>
                                <td class="text-center">{!! page_type($page->type) !!}</td>
                                @if($page->type == 1)
                                    <td>{{$page->title}}</td>
                                @else
                                    <td>{{$page->url}}@if($page->url_target) ({{$page->url_target}})@endif</td>
                                @endif
                                <td class="text-center">{{$page->created_at->format('Y-m-d H:i')}}</td>
                                <td class="option-120">
                                    <div class="btn-group">

                                    @if($page->type == 1)
                                        <a href="{{route('admin.page.edit', ['page' => $page->id, 'lang' => 'en'])}}" class="btn action-button lang-button me-1" data-toggle="tooltip" data-placement="top" title="Edytuj"><img src="{{ asset('/cms/flags/en.png') }}" alt="Tłumaczenie: en"></a>
                                        <a href="{{route('admin.page.edit', $page->id)}}" class="btn action-button me-1" data-toggle="tooltip" data-placement="top" title="Edytuj"><i class="fe-edit"></i></a>
                                        @else
                                        <a href="{{route('admin.url.edit', ['url' => $page->id, 'lang' => 'en'])}}" class="btn action-button lang-button me-1" data-toggle="tooltip" data-placement="top" title="Edytuj"><img src="{{ asset('/cms/flags/en.png') }}" alt="Tłumaczenie: en"></a>
                                        <a href="{{route('admin.url.edit', $page->id)}}" class="btn action-button me-1" data-toggle="tooltip" data-placement="top" title="Edytuj"><i class="fe-edit"></i></a>
                                        @endif
                                        <form method="POST" action="{{route('admin.page.destroy', $page->id)}}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn action-button confirm" data-toggle="tooltip" data-placement="top" title="Usuń" data-id="{{ $page->id }}"><i class="fe-trash-2"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @if($page->children->count() > 0)
                                @include('admin.page.children', array('pages' => $page->children))
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
