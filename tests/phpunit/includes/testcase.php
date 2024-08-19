<?php
/**
 * Basic abstract test class.
 *
 * All WordPress unit tests should inherit from this class.
 */
abstract class WP_UnitTestCase extends WP_UnitTestCase_Base {

    use \WPWCore\Testing\MakesHttpRequest,\WPWCore\Testing\PluginApplication,\WPWCore\Testing\DatabaseMigrations;

    public function createApplication()
    {



        $app = require dirname(__DIR__,3)."/bootstrap/app.php";

        return $app;
    }

}
