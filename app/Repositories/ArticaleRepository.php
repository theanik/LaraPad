<?php
namespace App\Repository;

use App\Articale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ArticaleRepository
{
    public function index()
    {
        $articale = Cache::get('articale', []);
        if(!$articale){
            $articale = Articale::all();
            Cache::forever('articale', $articale);
        }
        return $articale;
    }
    
    public function store(Request $articaleRequest)
    {
        $articale = Articale::firstOrNew([
            'title' => $articaleRequest->input('title')
        ]);
        $articale->body = $articaleRequest->input('body');
        $articale->category_id = $articaleRequest->input('category_id');
        $articale->save();

        return $articale;
    }
}