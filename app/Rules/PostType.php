<?php

namespace __PLUGIN_NAMESPACE__\Rules;

use Closure;
use __PLUGIN_NAMESPACE__\Models\Post;
use WpWhales\Contracts\Validation\Rule;

class PostType implements Rule
{

    private $post_type = "";

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($post_type)
    {
        $this->post_type = $post_type;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $post = Post::find($value);
        if ($post && $post->post_type === $this->post_type) {

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
        return 'Invalid Fighter';
    }
}
