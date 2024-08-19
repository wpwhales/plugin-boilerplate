<?php

namespace __PLUGIN_NAMESPACE__\Models;

use WPWCore\Database\Eloquent\Model;

class PostMeta extends Model
{

    protected $table = 'postmeta';

    public $timestamps = false;

    protected $fillable = [
        "post_id",
        "meta_key",
        "meta_value"
    ];

    public function post(){

        return $this->belongsTo(Post::class,"post_id","ID");
    }


}
