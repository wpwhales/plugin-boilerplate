<?php
/**
 * Plugin Name: __PLUGIN_NAME__
 * Plugin URI: https://wpwhales.io
 * Description: __PLUGIN_DESCRIPTION__
 * Version: 1.0.0
 * Requires PHP: 8.1
 * Author: WPWhales
 * Author URI: https://wpwhales.io
 */

require_once __DIR__ ."/vendor/autoload.php";

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| First we need to get an application instance. This creates an instance
| of the application / container and bootstraps the application so it
| is ready to receive HTTP / Console requests from the environment.
|
*/

$app = require __DIR__.'/bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

add_action("plugins_loaded",function() use($app){
    $app->run();
});


