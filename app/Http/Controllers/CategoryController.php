<?php

namespace App\Http\Controllers;

use Exception;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Repository\CategoryRepository;
use Barryvdh\Debugbar\Middleware\DebugbarEnabled;

class CategoryController extends Controller
{
    protected $model;

    
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->model = new CategoryRepository;
    }
    /**
     * index
     *
     * @return void
     */


    public function index()
    {
        $category = $this->model->index();

        return view('category.index',compact('category'));
    }

    public function store(CategoryRequest $categoryRequest, CategoryRepository $categoryRepository)
    {
        
        try{
            $categoryRequest->validated();

            $categoryRepository->store($categoryRequest);

            return redirect()->route('category.index');
            
        }catch(Exception $e){
            // Debugbar::addThrowable($e);
            return "{$e->getMessage()} : {$e->getCode()}";
        }

    }
    
}
