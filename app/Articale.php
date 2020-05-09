<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articale extends Model
{
    protected $guarded = [];

    public function setTitleAttribute($value=''){
        $this->attributes['title'] = trim($value);
        $this->attributes['slug'] = $this->slugify($value);
    }

    private function slugify($value){
        $value = strtolower(str_replace(' ','-',$value));
        return $value;
    }
}
