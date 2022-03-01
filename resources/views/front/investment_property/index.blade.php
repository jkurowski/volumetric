@extends('layouts.page', ['body_class' => 'investments'])

@section('meta_title', 'Inwestycje - '.$investment->name)

@section('pageheader')
    @include('layouts.partials.page-header', ['page' => $page])
@stop

@section('content')
    <div class="container">
        <div class="row border-bottom pb-3 mb-3">
            <div class="col-8">
                <h1>{{$investment->name}} @if($investment->type == 1) - {{$building->name}} @endif - {{$floor->name}} - {{$property->name}}</h1>
            </div>
            <div class="col-4 text-right">
                <a href="
                @if($investment->type == 1)
                {{route('front.investment.building.floor.index', [$investment, $building, $floor])}}
                @else
                {{route('front.investment.floor.index', [$investment, $floor])}}
                @endif
                " class="bttn bttn-right"><i class="las la-arrow-left"></i> Wróć do listy</a>
            </div>
        </div>
        <div class="row">
            <div class="col-6 property-desc">
                <h2>{{$property->name}}</h2>
                <ul class="list-unstyled">
                    <li>Pokoje:<span>{{$property->rooms}}</span></li>
                    <li>Powierzchnia:<span>{{$property->area}} m<sup>2</sup></span></li>
                    <li>Piętro:<span>xxx</span></li>
                    <li>Aneks/Kuchnia:<span>xxx</span></li>
                    <li>Wystawa okienna:<span>xxx<br></span></li>
                </ul>
            </div>
            <div class="col-6 d-flex align-items-center justify-content-center pl-5">
                @if($property->file)
                    <a href="/investment/property/{{$property->file}}"><img src="{{ asset('/investment/property/thumbs/'.$property->file.'') }}" alt="{{$property->name}}" alt="{{$property->name}}"></a>
                @endif
            </div>
        </div>
    </div>

    <div id="property-contact">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-9">
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
                                    <label for="form_name">Imię <span class="text-danger">*</span></label>
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
                                    <label for="form_email">E-mail <span class="text-danger">*</span></label>
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
                                    <label for="form_phone">Telefon</label>
                                    <input name="form_phone" id="form_phone" class="form-control" type="text" value="{{ old('form_phone') }}">
                                </div>
                            </div>

                            <div class="col-12 mt-2">
                                <div class="form-input">
                                    <label for="form_subject">Temat wiadomości <span class="text-danger">*</span></label>
                                    <input name="form_subject" id="form_subject" class="validate[required] form-control @error('form_subject') is-invalid @enderror" type="text" value="{{ old('form_subject') }}">

                                    @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="form-input">
                                    <label for="form_message">Treść wiadomości <span class="text-danger">*</span></label>
                                    <textarea rows="5" cols="1" name="form_message" id="form_message" class="validate[required] form-control @error('form_message') is-invalid @enderror">{{ old('form_message') }}</textarea>

                                    @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 rodo-obligation mt-3">
                                <p>Na podstawie z art. 13 ogólnego rozporządzenia o ochronie danych osobowych z dnia 27 kwietnia 2016 r. (Dz. Urz. UE L 119 z 04.05.2016) informujemy, iż przesyłając wiadomość za pomocą formularza kontaktowego wyrażacie Państwo zgodę na (<a href="" target="_blank">polityka informacyjna</a>):</p>
                            </div>

                            <div class="col-12 rodo-rules pt-1">
                                @foreach ($rules as $r)
                                    <label for="zgoda_{{$r->id}}" class="rules-text"><input name="rule_{{$r->id}}" id="rule_{{$r->id}}" value="1" type="checkbox" @if($r->required === 1) class="validate[required]" @endif data-prompt-position="topLeft:0">{!! $r->text !!}</label>
                                @endforeach
                            </div>
                        </div>
                        <div class="row row-form-submit">
                            <div class="col-12 pt-4">
                                <div class="input">
                                    <input name="form_page" type="hidden" value="{{$investment->name}} @if($investment->type == 1) - {{$building->name}} @endif - {{$floor->name}} - {{$property->name}}">
                                    <script type="text/javascript">
                                        document.write("<button class=\"bttn\" type=\"submit\">Wyślij wiadomość</button>");
                                    </script>
                                    <noscript><p><b>Do poprawnego działania, Java musi być włączona.</b><p></noscript>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        #page {
            padding: 100px 0 0
        }
    </style>
@endsection
@push('scripts')
    <script src="{{ asset('/js/validation.js') }}" charset="utf-8"></script>
    <script src="{{ asset('/js/pl.js') }}" charset="utf-8"></script>
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
