@extends('layouts.page', ['body_class' => 'page-investment'])

@section('meta_title', 'Inwestycje w sprzedaży')

@section('pageheader')
    @include('layouts.partials.page-header', ['page' => $page])
@stop

@section('content')
    @foreach($investments as $investment)
    <section>
        <div class="container">
            <div class="row @if($loop->odd) flex-row-reverse @endif position-relative">
                <div class="col-7">
                    <img src="{{ asset('/uploads/investments/thumbs/'.$investment->file_thumb) }}" alt="{{ $investment->city }} - {{ $investment->name }}">
                </div>
                <div class="col-6 position-absolute offset-absolute d-flex align-items-center @if($loop->odd) pr-0 @else offset-6 pl-0 @endif">
                    <div class="offset-apla">
                        <div class="section-header text-center">
                            <span>{{ $investment->city }}</span>
                            <h2>{{ $investment->name }}</h2>
                        </div>
                        <p class="text-center">{{ $investment->entry_content }}</p>
                        <div class="d-flex justify-content-center">
                            <a href="{{ $investment->url }}" class="bttn @if(!$investment->entry_content) mt-0 @endif " target="_blank">@lang('cms.goformore-button')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach
@endsection

@push('scripts')

    </script>
@endpush
