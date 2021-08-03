<div class="textSlider container pt-5 pb-5">
    <div class="row">
        <ul class="list-unstyled mb-0">
    @foreach ($list as $p)
            <li><img src="/uploads/gallery/images/{{$p->file}}" alt="{{ $p->name }}"></li>
    @endforeach
        </ul>
    </div>
</div>
