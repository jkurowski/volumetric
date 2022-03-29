<footer>
    <div id="footer">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <img src="{{asset('images/logo-volumetric.png') }}" alt="Nowe mieszkania deweloperskie Warszawa – Volumetric Polska Sp. z o.o.">
                    <p>Volumetric Polska Sp. z o. o.</p>
                    <p class="small">00-121 Warszawa, ul. Sienna 39, Kapitał podstawowy 12.000.000 PLN, NIP 527-24-89-354, KRS 0000245576, Sąd Rejonowy dla M. St. Warszawy w Warszawie VII Wydział Gospodarczy Krajowego Rejestru Sądowego
                    </p>
                </div>
                <div class="col"></div>
                <div class="col-2">
                    <h5>Menu</h5>
                    <ul class="mb list-unstyled">
                        <li><a href="/{{ $current_locale }}">@lang('cms.menu-homepage')</a></li>
                        <li><a href="{{ route('about.index') }}">@lang('cms.menu-aboutus')</a></li>
                        <li><a href="{{ route('investment.index') }}">@lang('cms.menu-investment')</a></li>
                        <li><a href="{{ route('planned.index') }}">@lang('cms.menu-planned')</a></li>
                        <li><a href="{{ route('contact.index') }}">@lang('cms.menu-contact')</a></li>
                    </ul>
                </div>

                <div class="col-3 ps-5">
                    <h5>@lang('cms.menu-investment')</h5>
                    <ul class="mb list-unstyled">
                        @foreach($investments as $investment)
                            <li><a href="{{ $investment->url }}" target="_blank">{{ $investment->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-3">
                    <h5>@lang('cms.menu-contact')</h5>
                    <ul class="mb list-unstyled">
                        <li><a href="tel:22 654 38 38">22 654 38 38</a></li>
                        <li><a href="tel:+48664130140">664 130 140</a></li>
                        <li><a href="mailto:biuro@volumetric.pl">biuro@volumetric.pl</a></li>
                        <li><a href="https://goo.gl/maps/3z5dJMdUa8L16N117" target="_blank">ul. Sienna 39, <br>00-121 Warszawa</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
