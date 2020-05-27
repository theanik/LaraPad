<?php
namespace App\Services;

use App\Articale;

class AtricateServices
{
    public function getFilterArticale()
    {
        
        $articale = Articale::with('category')->get();
        return $articale->filter(function($entity){
            if(strlen($entity->title) <= 10){
                return true;
            }
        });
         
    }

}