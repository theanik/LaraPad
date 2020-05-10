<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articale extends Model
{
    protected $guarded = [];
    
    /**
     * setTitleAttribute
     *
     * @param  mixed $value
     * @return void
     */
    public function setTitleAttribute($value=''){
        $this->attributes['title'] = trim($value);
        $this->attributes['slug'] = $this->slugify($value);
    }
    
    /**
     * slugify
     *
     * @param  mixed $value
     * @return void
     */
    private function slugify($value){
        $value = strtolower(str_replace(' ','-',$value));
        return $value;
    }
    
    /**
     * scopeGetNewest
     *
     * @param  mixed $qyery
     * @param  mixed $days
     * @return void
     */
    public function scopeGetNewest($qyery, $days)
    {
        $qyery->where('created_at', '>' , now()->subDays($days));
        return $qyery;
    }   
}
