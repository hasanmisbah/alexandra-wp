<?php

use Alexandra\Activator;

if(!function_exists('alexandraActivate')) {
    function alexandraActivate(): void
    {
        Activator::activate();
    }
}

if(!function_exists('alexandraDeactivate')) {
    function alexandraDeactivate(): void
    {
        Activator::deactivate();
    }
}