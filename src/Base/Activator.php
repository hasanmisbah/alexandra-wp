<?php

namespace Alexandra\Base;

use Alexandra\App\Alexandra;

/**
 * * Activator
 *
 * @author            Hasan Misbah
 * @package           Alexandra
 * @copyright         2022 Hasan Misbah
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 */
class Activator
{
    public static function activate()
    {
        flush_rewrite_rules();
    }

    public static function deactivate()
    {
        $instance = new Alexandra();
        $instance->unregister();
        flush_rewrite_rules();
    }

}
