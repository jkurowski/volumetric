<?php

if (! function_exists('changeLocaleUrl')) {
    function changeLocaleUrl(Illuminate\Routing\Route $route, $newLocale)
    {

        $parameters = $route->parameters();
        $parameters['locale'] = $newLocale;
        $name = $route->getName();

        return route($name, $parameters);
    }
}
