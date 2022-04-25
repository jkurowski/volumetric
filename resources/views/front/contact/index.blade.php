@extends('layouts.page', ['body_class' => 'page-contact'])

@section('meta_title', $page->title)

@section('pageheader')
    @include('layouts.partials.page-header', ['page' => $page])
@stop

@section('content')

    <section id="contact-form" class="pt-0">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <div class="section-header text-center">
                        <span>@lang('cms.formbox-title')</span>
                        <h2>@lang('cms.formbox-subtitle')</h2>
                    </div>
                </div>
                <div class="col-8 mt-5 pt-5">
                    @if (session('success'))
                        <div class="alert alert-success border-0">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning border-0">
                            {{ session('warning') }}
                        </div>
                    @endif
                    <form method="post" action="{{route('contact.send')}}" class="validateForm">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-4">
                                <div class="form-input">
                                    <label for="form_name">@lang('cms.form-name') <span class="text-danger">*</span></label>
                                    <input name="form_name" id="form_name" class="validate[required] form-control @error('form_name') is-invalid @enderror" type="text" value="{{ old('form_name') }}">

                                    @error('form_name')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-input">
                                    <label for="form_email">@lang('cms.form-email') <span class="text-danger">*</span></label>
                                    <input name="form_email" id="form_email" class="validate[required] form-control @error('form_email') is-invalid @enderror" type="text" value="{{ old('form_email') }}">

                                    @error('form_email')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-input">
                                    <label for="form_phone">@lang('cms.form-phone')</label>
                                    <input name="form_phone" id="form_phone" class="form-control" type="text" value="{{ old('form_phone') }}">
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="form-input">
                                    <label for="form_message">@lang('cms.form-message') <span class="text-danger">*</span></label>
                                    <textarea rows="5" cols="1" name="form_message" id="form_message" class="validate[required] form-control @error('form_message') is-invalid @enderror">{{ old('form_message') }}</textarea>

                                    @error('message')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 rodo-obligation">
                                <p>Na podstawie z art. 13 ogólnego rozporządzenia o ochronie danych osobowych z dnia 27 kwietnia 2016 r. (Dz. Urz. UE L 119 z 04.05.2016) informujemy, iż przesyłając wiadomość za pomocą formularza kontaktowego wyrażacie Państwo zgodę na (<a href="" target="_blank">polityka informacyjna</a>):</p>
                            </div>

                            <div class="col-12 rodo-rules pt-1">
                                @foreach ($rules as $r)
                                    <label for="zgoda_{{$r->id}}" class="rules-text"><input name="rule_{{$r->id}}" id="rule_{{$r->id}}" value="1" type="checkbox" @if($r->required === 1) class="validate[required]" @endif data-prompt-position="topLeft:0">{!! $r->text !!}</label>
                                @endforeach
                            </div>
                        </div>
                        <div class="row row-form-submit">
                            <div class="col-12 pt-4 d-flex justify-content-center">
                                <div class="input">
                                    <input name="form_page" type="hidden" value="Formularz kontaktowy">
                                    <script type="text/javascript">
                                        document.write("<button class=\"bttn\" type=\"submit\">@lang('cms.sendform-button')</button>");
                                    </script>
                                    <noscript><p><b>Do poprawnego działania, Java musi być włączona.</b><p></noscript>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section id="maincontact" class="pt-0">
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

    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d323.61840806792065!2d21.001932191294195!3d52.2317461856938!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471ecc8c3a369ce7%3A0x21b3f865e99c8572!2sVolumetric%20Polska%20Sp.%20z%20o.o.!5e0!3m2!1spl!2spl!4v1646411664558!5m2!1spl!2spl" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
@endsection
@push('scripts')
    <script src="{{ asset('js/validation.js') }}" charset="utf-8"></script>
    <script src="{{ asset('js/'.$current_locale.'.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".validateForm").validationEngine({
                validateNonVisibleFields: true,
                updatePromptsPosition:true,
                promptPosition : "topRight:-137px"
            });
        });
    </script>
@endpush
