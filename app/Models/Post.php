<?php

namespace __PLUGIN_NAMESPACE__\Models;

use WPWCore\Database\Eloquent\Model;


class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'ID';

    public $timestamps = false;

    protected $hidden = ["post_password"];

    protected $fillable = [
        'post_author',
        'post_date',
        'post_date_gmt',
        'post_content',
        'post_title',
        'post_excerpt',
        'post_status',
        'comment_status',
        'ping_status',
        'post_password',
        'post_name',
        'to_ping',
        'pinged',
        'post_modified',
        'post_modified_gmt',
        'post_content_filtered',
        'post_parent',
        'guid',
        'menu_order',
        'post_type',
        'post_mime_type',
        'comment_count',
    ];



    public function author()
    {
        return $this->belongsTo(User::class, 'post_author', 'ID');
    }

    public function meta()
    {

        return $this->hasMany(PostMeta::class, "post_id", "ID");
    }

    public function categories(){


        return $this->hasMany(TermRelationship::class,"object_id","ID");
    }





}
