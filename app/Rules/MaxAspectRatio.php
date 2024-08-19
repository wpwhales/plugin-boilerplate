<?php

namespace __PLUGIN_NAMESPACE__\Rules;

use Closure;
use WPWhales\Contracts\Validation\Rule;
class MaxAspectRatio implements Rule
{
    protected $maxAspectRatio;

    public function __construct($maxAspectRatio)
    {
        $this->maxAspectRatio = $maxAspectRatio;
    }

    public function passes($attribute, $value)
    {
        if (!$value->isValid()) {
            return false;
        }

        list($width, $height) = getimagesize($value->getPathname());
        $aspectRatio = $width / $height;

        return $aspectRatio <= $this->maxAspectRatio;
    }

    public function message()
    {
        return 'The :attribute should have a maximum aspect ratio of ' . $this->maxAspectRatio;
    }
}
