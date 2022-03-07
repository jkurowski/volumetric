<div class="header-holder position-fixed">
    <header>
        <div id="header">
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="col-3 d-flex align-items-center">
                        <div id="logo">
                            <a href="/{{ $current_locale }}">
                                <img src="{{asset('images/logo.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center justify-content-center">
                        <nav>
                            <a href="/{{ $current_locale }}">Strona główna</a>
                            <a href="">Poznaj nas</a>
                            <a href="{{ route('investment.index') }}">W sprzedaży</a>
                            <a href="{{ route('planned.index') }}">W przygotowaniu</a>
                            <a href="{{ route('contact.index') }}">Kontakt</a>
                        </nav>
                    </div>
                    <div class="col-3 d-flex align-items-center justify-content-end">
                        <a href="{{ route('contact.index') }}" class="bttn">ZAPYTAJ O OFERTĘ</a>
                        <div id="lang">
                            @foreach($available_locales as $available_locale => $locale_name)<a href="{{ changeLocaleUrl(Route::current(), $available_locale) }}" @if($available_locale === $current_locale) class="active" @endif>{{ $available_locale }}</a>@endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
