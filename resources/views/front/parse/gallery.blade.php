<div id="photos-list" class="container pt-5 pb-5">
    <div class="row">
        @foreach ($list as $p)
        <div class="col-3">
            <div class="col-gallery-thumb"><a href="/uploads/gallery/images/{{$p->file}}" class="swipebox" rel="gallery-1" title=""><img src="/uploads/gallery/images/thumbs/{{$p->file}}" alt="{{ $p->name }}"><div></div></a></div>
            </div>
        @endforeach
    </div>
</div>
