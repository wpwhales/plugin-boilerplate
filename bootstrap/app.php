<?php



$app = new \__PLUGIN_NAMESPACE__\Application(dirname(__DIR__));

$app->singleton(WPWhales\Contracts\Debug\ExceptionHandler::class, \__PLUGIN_NAMESPACE__\Exceptions\Handler::class);
$app->singleton(\WPWhales\Contracts\Console\Kernel::class,\__PLUGIN_NAMESPACE__\Console\Kernel::class);

/**
 * Config Files
 */

$app->configure("assets");
$app->configure("filesystems");


/**
 * some features initializations
 */
$app->withEloquent();
$app->withFacades();
$app->withActionScheduler();

/**
 * Global Middlewares
 */
$app->middleware(\__PLUGIN_NAMESPACE__\Http\Middlewares\VerifyCsrfToken::class);

/**
 * Middlewares
 */
$app->routeMiddleware(["auth"=> \__PLUGIN_NAMESPACE__\Http\Middlewares\Authenticate::class,
                       "signed"=>\WPWCore\Routing\Middleware\ValidateSignature::class]);


$app->register(\__PLUGIN_NAMESPACE__\Providers\BindingServiceProvider::class);
$app->register(\__PLUGIN_NAMESPACE__\Providers\HooksServiceProvider::class);
$app->register(\__PLUGIN_NAMESPACE__\Providers\EventsServiceProvider::class);

$app->singleton(\WPWCore\Models\User::class,function(){
    return new \__PLUGIN_NAMESPACE__\Models\User();
});

$app->createWebRoutesFromFile(dirname(__DIR__)."/routes/web.php",["namespace"=>"\__PLUGIN_NAMESPACE__\Http\Controllers"]);
$app->createAjaxRoutesFromFile(dirname(__DIR__)."/routes/ajax.php",["namespace"=>"\__PLUGIN_NAMESPACE__\Http\Controllers\API"]);
$app->createWordpressRoutesFromFile(dirname(__DIR__)."/routes/wordpress.php",["namespace"=>"\__PLUGIN_NAMESPACE__\Http\Controllers\Wordpress"]);


return $app;