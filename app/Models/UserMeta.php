<?php

namespace __PLUGIN_NAMESPACE__\Models;


use WPWCore\Database\Eloquent\Model as Eloquent;

class UserMeta extends Eloquent
{

    protected $table = 'usermeta';
    protected $primaryKey = 'umeta_id';

    public $timestamps = false;

    public function getMetaValueAttribute($value)
    {
        if (is_serialized($value)) {

            return unserialize($value);
        }

        return $value;

    }

    protected $fillable = [
        "user_id",
        "meta_key",
        "meta_value"
    ];


}
