<?php

/**
 *  * Alexandra
 *
 * @author            Hasan Misbah
 * @package           Alexandra
 * @copyright         2022 Hasan Misbah
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 */

/**
 * Plugin Name:       Alexandra
 * Plugin URI:        https://example.com/plugin-name
 * Description:       Learning plugin Development (The only plugin you need in WordPress to Build Rocket launcher or
 * atom bomb)
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.1
 * Author:            Hasan Misbah
 * Author URI:        https://github.com/hasanmisbah
 * Text Domain:       alexandra
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Check if accessing directly
defined('ABSPATH') or die();


// Check if autoload file exist
// if not exist it will kill the app or force to suicide the app
if (!file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    die();
}

// Load Autoload File
require_once dirname(__FILE__) . '/vendor/autoload.php';

// Create a new instance of plugin and run it
$application = new \Alexandra\App\Alexandra();
$application->boot();

// Register activation action
register_activation_hook(__FILE__, 'alexandraActivate');

// Register Deactivation action
register_deactivation_hook(__FILE__, 'alexandraDeactivate');
