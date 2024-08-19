<?php

namespace __PLUGIN_NAMESPACE__\Providers;


use __PLUGIN_NAMESPACE__\Models\User;
use WPWhales\Support\ServiceProvider;

class BindingServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->app["bindingResolver"]->bind("user",User::class);


    }


}
