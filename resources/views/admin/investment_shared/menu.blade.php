<div class="card-header border-bottom card-nav">
    <nav class="nav">
        <a class="nav-link " href="{{route('admin.developro.edit', 3)}}"><span class="fe-info"></span> {{$investment->name}}</a>
        @if ($investment->type == 1)
            <a class="nav-link {{ Request::routeIs('admin.developro.investment.building.index') ? ' active' : '' }}" href="{{route('admin.developro.investment.building.index', $investment->id)}}"><span class="fe-package"></span> Lista budynków</a>
        @endif

        @if ($investment->type == 2)
            <a class="nav-link {{ Request::routeIs('admin.developro.investment.floor.index') ? ' active' : '' }}" href="{{route('admin.developro.investment.floor.index', $investment->id)}}"><span class="fe-layers"></span> Lista kondygnacji</a>
        @endif

        @if ($investment->type == 3)
            <a class="nav-link {{ Request::routeIs('admin.developro.investment.house.index') ? ' active' : '' }}" href="{{route('admin.developro.investment.house.index', $investment->id)}}"><span class="fe-package"></span> Lista domów</a>
        @endif

        @if (Request::routeIs('admin.developro.investment.floor.property.index'))
            <a class="nav-link active" href=""><span class="fe-square"></span>{{$floor->name}} -  Lista mieszkań</a>
        @endif

        @if (Request::routeIs('admin.developro.investment.building.floor.index') || Request::routeIs('admin.developro.investment.building.floor.property.index'))
            <a class="nav-link {{ Request::routeIs('admin.developro.investment.building.floor.index') ? ' active' : '' }}" href="{{route('admin.developro.investment.building.floor.index', [$investment, $building])}}"><span class="fe-layers"></span>{{$building->name}} -  Lista kondygnacji</a>
        @endif

        @if (Request::routeIs('admin.developro.investment.building.floor.property.index'))
            <a class="nav-link active" href=""><span class="fe-square"></span>{{$floor->name}} -  Lista mieszkań</a>
        @endif

        <a class="nav-link {{ Request::routeIs('admin.developro.plan.index') ? ' active' : '' }}" href="{{route('admin.developro.plan.index', $investment)}}"><span class="fe-image"></span> Plan</a>
    </nav>
</div>
