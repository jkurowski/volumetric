<div class="card-header border-bottom card-nav">
    <nav class="nav">
        <a class="nav-link {{ Request::routeIs('admin.tracker.index', 'admin.tracker.log') ? 'active' : '' }}" href="{{route('admin.tracker.index')}}"><span class="fe-bar-chart-line-"></span> Odwiedziny strony</a>
        <a class="nav-link {{ Request::routeIs('admin.tracker.events', 'admin.tracker.event') ? 'active' : '' }}" href="{{route('admin.tracker.events')}}"><span class="fe-bell"></span> Wydarzenia</a>
    </nav>
</div>
