<?php

namespace __PLUGIN_NAMESPACE__\Rules;

use Closure;
use WPWhales\Contracts\Validation\Rule;
class MinAspectRatio implements Rule
{
    protected $minAspectRatio;

    public function __construct($minAspectRatio)
    {
        $this->minAspectRatio = $minAspectRatio;
    }

    public function passes($attribute, $value)
    {
        if (!$value->isValid()) {
            return false;
        }

        list($width, $height) = getimagesize($value->getPathname());
        $aspectRatio = $width / $height;

        return $aspectRatio >= $this->minAspectRatio;
    }

    public function message()
    {
        return 'The :attribute should have a minimum aspect ratio of ' . $this->minAspectRatio;
    }
}
