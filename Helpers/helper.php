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

if (! function_exists('mix')) {
    /**
     * Get the path to a versioned Mix file.
     *
     * @param string $path
     * @param string $manifestDirectory
     * @return string
     *
     * @throws \Exception
     */
    function mix(string $path, string $manifestDirectory = ''): string
    {
        static $manifest;

        $publicFolder = ALEXANDRA_ASSETS_PATH;
        $rootPath = $_SERVER['DOCUMENT_ROOT'];
        $publicPath = $rootPath . $publicFolder;

        if ($manifestDirectory && ! str_starts_with($manifestDirectory, '/')) {
            $manifestDirectory = "/{$manifestDirectory}";
        }

        if (! $manifest) {

            if (! file_exists($manifestPath = ($rootPath . $manifestDirectory.'/mix-manifest.json') )) {
                throw new Exception('The Mix manifest does not exist.');
            }

            $manifest = json_decode(file_get_contents($manifestPath), true);
        }

        if (! str_starts_with($path, '/')) {
            $path = "/{$path}";
        }

        $path = $publicFolder . $path;

        if (! array_key_exists($path, $manifest)) {

            throw new Exception(
                "Unable to locate Mix file: {$path}. Please check your ".
                'webpack.mix.js output paths and try again.'
            );

        }

        return file_exists($publicPath . ($manifestDirectory.'/hot'))
            ? "http://localhost:8080{$manifest[$path]}"
            : $manifestDirectory.$manifest[$path];
    }
}
