@extends('layouts.page', ['body_class' => 'investments'])

@section('meta_title', 'Inwestycje')

@section('pageheader')
    @include('layouts.partials.page-header', ['page' => $page])
@stop

@section('content')
    <div class="container">
        <div class="row">
            @foreach($list as $investment)
            <div class="col-12 pb-5">
                <div class="investments-item">
                    @if($investment->file_thumb)
                        <div class="investments-item-header">
                            <a href="{{route('front.investment.show', $investment->id)}}"><img src="{{asset('investment/thumbs/'.$investment->file_thumb) }}" alt="{{ $investment->name }}"></a>
                        </div>
                    @endif
                    <div class="investments-item-content">
                        <h6 class="sub-title">{{$investment->city}}</h6>
                        <h2 class="title"><a href="{{route('front.investment.show', $investment->id)}}">{{$investment->name}}</a></h2>
                        <p>{{$investment->content_entry}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
@push('scripts')

@endpush
