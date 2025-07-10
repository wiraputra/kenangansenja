<?php
if (!function_exists('setActive')) {
    function setActive($route)
    {
        return request()->is($route) ? 'bg-blue-700' : 'hover:bg-blue-600';
    }
}
