<?php

namespace __PLUGIN_NAMESPACE__\Rules;

use Closure;
use WPWhales\Contracts\Validation\Rule;

class EmailExists implements Rule
{
     /**
         * Create a new rule instance.
         *
         * @return void
         */
        public function __construct()
        {
            //
        }
 /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $status = email_exists($value);
        if($status===false){
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The Email Address already exists" ;
    }

}
