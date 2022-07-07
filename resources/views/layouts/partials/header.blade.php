<div class="header-holder position-fixed">
    <header>
        <div id="header">
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="col-2 col-xl-3 d-flex align-items-center">
                        <div id="logo">
                            <a href="/{{ $current_locale }}">
                                <img src="{{asset('images/logo.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-6 d-none d-xl-flex align-items-center justify-content-center">
                        <nav>
                            <a href="/{{ $current_locale }}">@lang('cms.menu-homepage')</a>
                            <a href="{{ route('about.index') }}">@lang('cms.menu-aboutus')</a>
                            <!--<a href="{{ route('investment.index') }}">@lang('cms.menu-investment')</a>-->
                            <a href="{{ route('planned.index') }}">@lang('cms.menu-planned')</a>
                            <a href="{{ route('completed.index') }}">@lang('cms.menu-completed')</a>
                            <a href="{{ route('contact.index') }}">@lang('cms.menu-contact')</a>
                        </nav>
                    </div>
                    <div class="col-10 col-xl-3 d-flex align-items-center justify-content-end">
                        <a href="{{ route('contact.index') }}" class="bttn bttn-tel">@lang('cms.askforoffer-button')</a>
                        <div id="lang">
                            @foreach($available_locales as $available_locale => $locale_name)<a href="{{ changeLocaleUrl(Route::current(), $available_locale) }}" @if($available_locale === $current_locale) class="active" @endif>{{ $available_locale }}</a>@endforeach
                        </div>
                        <div id="triggermenu" class="bttn">MENU</div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
