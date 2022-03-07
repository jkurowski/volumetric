<div class="header-holder position-fixed">
    <header>
        <div id="header">
            <div class="container-fluid">
                <div class="row no-gutters">
                    <div class="col-2">
                        <p>1</p>
                    </div>
                </div>
            </div>

            @foreach($available_locales as $available_locale => $locale_name)
                    <a href="{{ changeLocaleUrl(Route::current(), $available_locale) }}">
                        <span>@if($available_locale === $current_locale) -> @endif {{ $locale_name }}</span>
                    </a>
            @endforeach

                <a href="/{{ $current_locale }}">Strona główna</a>
                <a href="{{ route('investment.index') }}">W sprzedaży</a>
                <a href="{{ route('planned.index') }}">W przygotowaniu</a>
                <a href="{{ route('contact.index') }}">Kontakt</a>

        </div>
    </header>
</div>
