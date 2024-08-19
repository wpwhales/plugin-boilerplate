<?php

namespace __PLUGIN_NAMESPACE__\Providers;

use WPWCore\Events\EventServiceProvider;
use function WPWCore\app;

class EventsServiceProvider extends EventServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [



    ];


    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [];
    /**
     * Register the application's event listeners.
     *
     * @return void
     */
    public function boot()
    {
        $events = app('events');

        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                $events->listen($event, $listener);
            }
        }

        foreach ($this->subscribe as $subscriber) {
            $events->subscribe($subscriber);
        }
    }

    /**
     * Get the events and handlers.
     *
     * @return array
     */
    public function listens()
    {
        return $this->listen;
    }



}
