<?php
namespace App\Repository;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryRepository
{

    public function index(){
        $category = Cache::get('category',[]);
        if(!$category){
            $category = Category::all();
            Cache::forever('category', $category);
        }
        return $category;
    }
    
    
    /**
     * store
     *
     * @param  mixed $categoryRequest
     * @return void
     */
    public function store(Request $categoryRequest)
    {
        $category = Category::firstOrCreate([
            'name' => $categoryRequest->input('name')
            ]);
        $category->save();

        return $category;
    }
}