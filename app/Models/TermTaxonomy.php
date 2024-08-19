<?php

namespace __PLUGIN_NAMESPACE__\Models;


use WPWCore\Database\Eloquent\Model as Eloquent;

class TermTaxonomy extends Eloquent
{


    protected $table = 'term_taxonomy';
    protected $primaryKey = 'term_taxonomy_id';


    public function term()
    {
        return $this->belongsTo(Term::class, "term_id", "term_id");
    }
}
