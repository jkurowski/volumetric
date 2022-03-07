<footer>
    <div id="footer">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <img src="{{asset('images/logo-volumetric.png') }}" alt="Nowe mieszkania deweloperskie Warszawa – Volumetric Polska Sp. z o.o.">
                    <p>Volumetric Polska Sp. z o. o.</p>
                    <p>Grup Volumetric SL jest holdingiem, którego wiodącą działalnością jest budownictwo deweloperskie.</p>
                </div>
                <div class="col"></div>
                <div class="col-2">
                    <h5>Menu</h5>
                    <ul class="mb list-unstyled">
                        <li><a href="/{{ $current_locale }}">Strona główna</a></li>
                        <li><a href="">Poznajmy się</a></li>
                        <li><a href="{{ route('investment.index') }}">W sprzedaży</a></li>
                        <li><a href="{{ route('planned.index') }}">W przygotowaniu</a></li>
                        <li><a href="{{ route('contact.index') }}">Kontakt</a></li>
                    </ul>
                </div>
                <div class="col-3 ps-5">
                    <h5>W sprzedaży</h5>
                    <ul class="mb list-unstyled">
                        <li><a href="">Górnośląska 6</a></li>
                        <li><a href="">Dom na Stawem Koziorożca</a></li>
                        <li><a href="">Szczęśliwicka 42</a></li>
                        <li><a href="">Przy Bażantarni</a></li>
                    </ul>
                </div>
                <div class="col-3">
                    <h5>Kontakt</h5>
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
