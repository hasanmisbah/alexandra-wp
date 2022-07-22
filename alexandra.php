<?php

/**
 * Alexandra
 *
 * @author            Hasan Misbah
 * @package           Alexandra
 * @copyright         2022 Hasan Misbah
 * @license           GPL-2.0-or-later
 */

// Check if accessing directly
defined('ABSPATH') or die();


// Check if autoload file exist
if(!file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    die();
}


require_once dirname(__FILE__) . '/vendor/autoload.php';

register_activation_hook(__FILE__, [Alexandra\Activator::class, 'activate']);
register_deactivation_hook(__FILE__, [Alexandra\Activator::class, 'deactivate']);