@extends('layouts.page', ['body_class' => 'investments'])

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
                    <a href="/investment/property/{{$property->file}}"><img src="/investment/property/thumbs/{{$property->file}}" alt="{{$property->name}}"></a>
                @endif
            </div>
        </div>
        <div class="row mt-5 pt-2">
            <div class="col-12 text-center pb-4">
                <h3>- Wyślij zapytanie -</h3>
            </div>
            <div class="col-12">
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
                <form method="post" action="{{route('contact.property', $property->id)}}" class="">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-4">
                            <label for="form_name">Imię <span class="text-danger">*</span></label>
                            <input name="name" id="form_name" class="validate[required] form-control @error('name') is-invalid @enderror" type="text" value="{{ old('name') }}">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-4 col-input">
                            <label for="form_email">E-mail <span class="text-danger">*</span></label>
                            <input name="email" id="form_email" class="validate[required] form-control @error('email') is-invalid @enderror" type="text" value="{{ old('email') }}">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-4 col-input">
                            <label for="form_phone">Telefon</label>
                            <input name="phone" id="form_phone" class="form-control" type="text" value="{{ old('phone') }}">
                        </div>
                        <div class="col-12 mt-2">
                            <label for="form_message">Treść wiadomości <span class="text-danger">*</span></label>
                            <textarea rows="5" cols="1" name="message" id="form_message" class="validate[required] form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>

                            @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-12 obowiazek">
                            <p>Na podstawie z art. 13 ogólnego rozporządzenia o ochronie danych osobowych z dnia 27 kwietnia 2016 r. (Dz. Urz. UE L 119 z 04.05.2016) informujemy, iż przesyłając wiadomość za pomocą formularza kontaktowego wyrażacie Państwo zgodę na (<a href="" target="_blank">polityka informacyjna</a>):</p>
                        </div>
                    </div>
                    <div class="row row-form-submit">
                        <div class="col-6"></div>
                        <div class="col-6 col-6-form-submit pt-4">
                            <div class="input text-right">
                                <script type="text/javascript">
                                    document.write("<button class=\"bttn\" type=\"submit\">WYŚLIJ <i class=\"lar la-paper-plane\"></i></button>");
                                </script>
                                <noscript><p><b>Do poprawnego działania, Java musi być włączona.</b><p></noscript>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
