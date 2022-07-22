<?php

/**
 * Helper
 * file contain helper function and it will be autoloaded and injected
 *
 * @author            Hasan Misbah
 * @package           Alexandra
 * @copyright         2022 Hasan Misbah
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 */

use Alexandra\Base\Activator;

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