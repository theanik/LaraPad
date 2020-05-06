<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function setNameAttribute($value=''){
        $this->attributes['name'] = trim($value);
        $this->attributes['slug'] = $this->slugify($value);
    }

    private function slugify($value){
        $value = strtolower(str_replace(' ','-',$value));
        return $value;
    }
}
