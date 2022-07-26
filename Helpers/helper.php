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
    /**
     * @return void
     */
    function alexandraActivate(): void
    {
        Activator::activate();
    }
}

if(!function_exists('alexandraDeactivate')) {
    /**
     * @return void
     */
    function alexandraDeactivate(): void
    {
        Activator::deactivate();
    }
}

if(!function_exists('isAssoc')) {
    /**
     * Determines if an array is associative.
     * @param  array  $array
     * @return bool
     */
    function isAssoc(array $array): bool
    {
        $keys = array_keys($array);

        return array_keys($keys) !== $keys;
    }
}

if(!function_exists('form')) {
    function form(): \Alexandra\Base\Form
    {
        return new \Alexandra\Base\Form();
    }
}
