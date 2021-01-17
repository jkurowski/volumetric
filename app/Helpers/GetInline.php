<?php

if (! function_exists('getInline')) {
    function getInline($array, $id, $element)
    {
        foreach ($array as $a) {
            if ($a->id == $id) {
                $elementArray = json_decode(json_encode($a), true);
                if ($element == 'file') {
                    return '/uploads/inline/'.$elementArray[$element];
                } else {
                    return $elementArray[$element];
                }
            }
        }
    }
}
