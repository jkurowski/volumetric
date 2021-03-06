<footer>
    <div id="footer">
        <div class="container">
            <div class="row">
                <div class="mb-4 mb-md-0 col-12 col-md-5 col-lg-4 pe-3 pe-md-5 pe-lg-3">
                    <img src="{{asset('images/logo-volumetric.png') }}" alt="Nowe mieszkania deweloperskie Warszawa – Volumetric Polska Sp. z o.o.">
                    <p>Volumetric Polska Sp. z o. o.</p>
                    <p class="small">ul. Sienna 39 <br>00-121 Warszawa, <br>NIP 527-24-89-354 <br>KRS 0000245576 <br>Kapitał zakładowy 25.000.000 PLN</p>
                </div>
                <div class="d-none d-lg-block col"></div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Menu</h5>
                    <ul class="mb list-unstyled">
                        <li><a href="/{{ $current_locale }}">@lang('cms.menu-homepage')</a></li>
                        <li><a href="{{ route('about.index') }}">@lang('cms.menu-aboutus')</a></li>
                        <li><a href="{{ route('investment.index') }}">@lang('cms.menu-investment')</a></li>
                        <li><a href="{{ route('planned.index') }}">@lang('cms.menu-planned')</a></li>
                        <li><a href="{{ route('contact.index') }}">@lang('cms.menu-contact')</a></li>
                    </ul>
                </div>
                <div class="col-3 ps-5 d-none">
                    <h5>@lang('cms.menu-investment')</h5>
                    <ul class="mb list-unstyled">
                        @foreach($investments as $investment)
                            <li><a href="{{ $investment->url }}" target="_blank">{{ $investment->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <h5>@lang('cms.menu-contact')</h5>
                    <ul class="mb list-unstyled">
                        <li><a href="tel:+48664130140">664 130 140</a></li>
                        <li><a href="tel:22 654 38 38">22 654 38 38</a></li>
                        <li><a href="mailto:biuro@volumetric.pl">biuro@volumetric.pl</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
