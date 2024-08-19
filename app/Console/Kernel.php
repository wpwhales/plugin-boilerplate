<?php

namespace __PLUGIN_NAMESPACE__\Console;


use WPWCore\ActionScheduler\ActionScheduler;
use WPWCore\Application;

class Kernel extends \WPWCore\Console\Kernel
{

    protected $commands = [

    ];

    public function __construct(Application $app)
    {


        parent::__construct($app);


    }

    protected function scheduleEvents(ActionScheduler $scheduler)
    {


    }
}
