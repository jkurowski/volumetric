@extends('layouts.page', ['body_class' => 'page-about'])

@section('meta_title', $page->title)

@section('pageheader')
    @include('layouts.partials.page-header', ['page' => $page])
@stop

@section('content')
    <section class="pt-0">
        <div class="container inline inline-tc">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-lg-9 col-xl-6 text-center">
                    <h2 data-modaltytul="2" class="mb-4">{{ getInline($array, 2, 'modaltytul') }}</h2>
                    <div data-modaleditortext="2">{!! getInline($array, 2, 'modaleditortext') !!}</div>
                </div>
            </div>
            @auth
            <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="2" data-hideinput="modaleditor,modallink,modallinkbutton,file,file_alt" data-method="update" data-imgwidth="796" data-imgheight="738"></button></div>
            @endauth
        </div>
        <div class="container pt-5 time-line">
            @foreach($about_investments as $investment)
                <div class="@if ($loop->even) row @elseif ($loop->odd) row flex-row-reverse @endif">
                    <span class="deadline">{{ $investment->deadline }}</span>
                    <div class="col-12 col-lg-6">
                        <div class="time-line-img">
                            <img src="{{ asset('/uploads/investments/thumbs/'.$investment->file_thumb) }}" alt="{{ $investment->city }} - {{ $investment->name }}">
                            @if($investment->gallery_id)
                                 <a href="{{ asset('/uploads/gallery/images/'.$investment->photos->first()->file) }}" class="bttn bttn-sm swipebox" rel="gallery-{{ $investment->gallery_id }}">POKAŻ GALERIĘ</a>
                                @foreach($investment->photos as $int => $image)
                                    @if($image->gallery_id == $investment->gallery_id && $int > 0)
                                        <a href="{{ asset('/uploads/gallery/images/'.$image->file) }}" class="swipebox" rel="gallery-{{ $investment->gallery_id }}"></a>
                                    @endif
                                @endforeach
                            @endif
                        </div>

                    </div>
                    <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="offset-apla">
                            <div class="section-header text-center">
                                <span>{{ $investment->city }}</span>
                                <h2>{{ $investment->name }}</h2>
                            </div>
                            <p class="text-center mb-4">{{ $investment->address }}</p>
                            <p class="text-center">{!! $investment->entry_content !!}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section id="maincontact" class="p-0">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-10">
                    <div class="maincontact">
                        <div class="container-fluid p-0">
                            <div class="row no-gutters">
                                <div class="col-8 ps-5 d-flex align-items-center justify-content-center">
                                    <div class="maincontact-text">
                                        <div class="section-header text-center">
                                            <span>@lang('cms.contactbox-title')</span>
                                            <h2>@lang('cms.contactbox-subtitle')</h2>
                                        </div>

                                        <ul class="mb-0 list-unstyled">
                                            <li><span class="square-icon"><img src="{{asset('svg/phone-icon.svg') }}" class="phone-svg-icon" alt="Numer telefonu"></span><a href="tel:226543838">22 654 38 38</a></li>
                                            <li><span class="square-icon"><img src="{{asset('svg/phone-icon.svg') }}" class="phone-svg-icon" alt="Numer telefonu"></span><a href="tel:664130140">664 130 140</a></li>
                                            <li><span class="square-icon"><img src="{{asset('svg/envelope-icon.svg') }}" class="envelope-svg-icon" alt="Numer telefonu"></span><a href="mailto:biuro@volumetric.pl">biuro@volumetric.pl</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-4 ps-5">
                                    <img src="{{asset('images/kontakt.jpg') }}" alt="@lang('cms.contactbox-title')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
