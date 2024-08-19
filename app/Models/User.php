<?php

namespace __PLUGIN_NAMESPACE__\Models;

use WPWCore\Http\Request;
use function WPWCore\app;

class User extends \WPWCore\Models\User
{


    public function hasRole($value)
    {
        global $wpdb;
        $prefix = $wpdb->prefix;


        if (empty($this->capabilities)) {
            $this->capabilities = $this->meta()->where("meta_key", "=", $prefix . "capabilities")->first()->meta_value;
        }
        $capabilities = $this->capabilities;

        if (in_array($value, array_keys($capabilities))) {
            return true;
        }

        return false;
    }

}