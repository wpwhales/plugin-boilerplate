<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Assets Manifest
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default asset manifest that should be used.
    | The "theme" manifest is recommended as the default as it cedes ultimate
    | authority of your application's assets to the theme.
    |
    */

    'default' => 'plugin',

    /*
    |--------------------------------------------------------------------------
    | Assets Manifests
    |--------------------------------------------------------------------------
    |
    | Manifests contain lists of assets that are referenced by static keys that
    | point to dynamic locations, such as a cache-busted location. We currently
    | support two types of manifest:
    |
    | assets: key-value pairs to match assets to their revved counterparts
    |
    | bundles: a series of entrypoints for loading bundles
    |
    */

    'manifests' => [
        'plugin' => [
            'path'    => dirname(__FILE__, 2) . "/build",
            'url'     => plugin_dir_url(__DIR__) . "build",
            'assets'  => dirname(__FILE__, 2) . "/build/manifest.json",
            'bundles' => dirname(__FILE__, 2) . "/build/entrypoints.json",
        ]
    ]
];
