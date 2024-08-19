<?php

namespace __PLUGIN_NAMESPACE__\Models;


use WPWCore\Database\Eloquent\Model as Eloquent;

class TermRelationship extends Eloquent
{

    protected $table = 'term_relationships';
    public $timestamps = false;
    protected $primaryKey = 'object_id';

    protected $fillable = [
        "object_id",
        "term_taxonomy_id",
        "term_order",
    ];



    public function taxonomy(){
        return $this->belongsTo(TermTaxonomy::class,"term_taxonomy_id","term_taxonomy_id");
    }

}
