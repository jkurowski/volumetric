@extends('layouts.page', ['body_class' => 'page-about'])

@section('meta_title', $page->title)

@section('pageheader')
    @include('layouts.partials.page-header', ['page' => $page])
@stop

@section('content')
    <section class="pt-0">
        <div class="container">
            <div class="row flex-row-reverse position-relative inline inline-tc">
                <div class="col-12 col-lg-6">
                    <img src="{{ getInline($array, 1, 'file') }}" alt="{{ getInline($array, 1, 'file_alt') }}" data-img="1">
                </div>
                <div class="col-12 col-lg-7 position-absolute pr-3 pr-lg-0 offset-absolute d-flex align-items-center">
                    <div class="offset-apla">
                        <div class="section-header text-center">
                            <span data-modaleditor="1">{{ getInline($array, 1, 'modaleditor') }}</span>
                            <h2 data-modaltytul="1">{{ getInline($array, 1, 'modaltytul') }}</h2>
                        </div>
                        <div data-modaleditortext="1">{!! getInline($array, 1, 'modaleditortext') !!}</div>
                    </div>
                </div>

                <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="1" data-hideinput="modallink,modallinkbutton" data-method="update" data-imgwidth="796" data-imgheight="738"></button></div>
            </div>
        </div>
    </section>

    <section class="pt-0">
        <div class="container">
            <div class="row position-relative inline inline-tc">
                <div class="col-12 col-lg-6">
                    <img src="{{ getInline($array, 3, 'file') }}" alt="{{ getInline($array, 3, 'file_alt') }}" data-img="3">
                </div>
                <div class="col-12 col-lg-7 position-absolute right pr-0 offset-absolute d-flex align-items-center">
                    <div class="offset-apla">
                        <div class="section-header text-center">
                            <span data-modaleditor="3">{{ getInline($array, 3, 'modaleditor') }}</span>
                            <h2 data-modaltytul="3">{{ getInline($array, 3, 'modaltytul') }}</h2>
                        </div>
                        <div data-modaleditortext="3">{!! getInline($array, 3, 'modaleditortext') !!}</div>
                    </div>
                </div>
                <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="3" data-hideinput="modallink,modallinkbutton" data-method="update" data-imgwidth="796" data-imgheight="738"></button></div>
            </div>
        </div>
    </section>

    <section>
        <div id="paralaxa">
            <div class="container">
                <div class="row d-flex justify-content-center inline inline-tc">
                    <div class="col-12 col-xl-7 text-center">
                        <img src="{{ asset('/uploads/inline/pzfd.png') }}" alt="Logo organizacji Polski Związek Firm Deweloperskich">
                        <div data-modaleditortext="4">{!! getInline($array, 4, 'modaleditortext') !!}</div>
                    </div>
                    <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="4" data-hideinput="modaltytul,modaleditor,modallink,modallinkbutton,file,file_alt" data-method="update" data-imgwidth="796" data-imgheight="738"></button></div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-0">
        <div class="container">
            <div class="row d-flex justify-content-center inline inline-tc">
                <div class="col-12 col-md-9 col-xl-7">
                    <div class="offset-apla offset-absolute">
                        <div class="section-header text-center">
                            <span data-modaleditor="5">{{ getInline($array, 5, 'modaleditor') }}</span>
                            <h2 data-modaltytul="5">{{ getInline($array, 5, 'modaltytul') }}</h2>
                        </div>
                        <div class="text-center">
                            <div data-modaleditortext="5">{!! getInline($array, 5, 'modaleditortext') !!}</div>
                        </div>
                    </div>
                </div>
                <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="5" data-hideinput="modallink,modallinkbutton,file,file_alt" data-method="update" data-imgwidth="796" data-imgheight="738"></button></div>
            </div>
            <div class="row mt-3 mt-sm-5">
                <div class="col-4">
                    <div class="p-0 p-md-4">
                        <a href="{{ asset('/uploads/inline/ds-1.jpg') }}" class="swipebox"><img src="{{ asset('/uploads/inline/ds-1-thumb.jpg') }}" alt="Pomoc społeczna"></a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="p-0 p-md-4">
                        <a href="{{ asset('/uploads/inline/ds-2.jpg') }}" class="swipebox"><img src="{{ asset('/uploads/inline/ds-2-thumb.jpg') }}" alt="Pomoc społeczna"></a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="p-0 p-md-4">
                        <a href="{{ asset('/uploads/inline/ds-3.jpg') }}" class="swipebox"><img src="{{ asset('/uploads/inline/ds-3-thumb.jpg') }}" alt="Pomoc społeczna"></a>
                    </div>
                </div>
            </div>
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
