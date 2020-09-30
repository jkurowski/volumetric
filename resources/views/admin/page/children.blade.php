@foreach ($pages as $page)
<tr>
    <td><i class="fe-corner-down-right" style="margin-left: {{$page->depth * 10}}px;margin-right: 15px"></i> {{$page->title}}</td>
    <td class="text-center">{!! status($page->menu) !!}</td>
    <td>
        @foreach($page->ancestors->pluck('title') as $path){{$path}} <i class="fe-chevrons-right"></i> @endforeach{{$page->title}}
    </td>
    <td class="text-center">{{$page->created_at->format('Y-m-d H:i')}}</td>
    <td class="option-120">
        <div class="btn-group">
            <a href="{{route('admin.page.edit', $page->id)}}" class="btn action-button mr-1" data-toggle="tooltip" data-placement="top" title="Edytuj"><i class="fe-edit"></i></a>
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
