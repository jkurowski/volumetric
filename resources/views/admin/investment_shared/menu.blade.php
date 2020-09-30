<div class="card-header border-bottom card-nav">
    <nav class="nav">
        <a class="nav-link " href="{{route('admin.developro.edit', $investment->id)}}"><span class="fe-info"></span> {{$investment->name}}</a>
        @if ($investment->type == 1)
            <a class="nav-link" href=""><span class="fe-package"></span> Lista budynków</a>
        @endif

        @if ($investment->type == 2)
            <a class="nav-link {{ Request::routeIs('admin.developro.floor.index') ? ' active' : '' }}" href="{{route('admin.developro.floor.index', $investment->id)}}"><span class="fe-layers"></span> Lista kondygnacji</a>
        @endif

        @if ($investment->type == 3)
            <a class="nav-link {{ Request::routeIs('admin.developro.house.index') ? ' active' : '' }}" href="{{route('admin.developro.house.index', $investment->id)}}"><span class="fe-package"></span> Lista domów</a>
        @endif

        @if (Request::routeIs('admin.developro.property.index'))
            <a class="nav-link active" href=""><span class="fe-square"></span>Lista mieszkań</a>
        @endif

        <a class="nav-link {{ Request::routeIs('admin.developro.plan.index') ? ' active' : '' }}" href="{{route('admin.developro.plan.index', $investment)}}"><span class="fe-image"></span> Plan</a>
    </nav>
</div>
