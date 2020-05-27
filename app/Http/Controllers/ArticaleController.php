<?php

namespace App\Http\Controllers;

use Exception;
use App\Articale;
use App\Category;
use Illuminate\Http\Request;
use App\Services\AtricateServices;
use App\Http\Requests\ArticaleRequest;
use App\Repository\ArticaleRepository;
use App\Repository\CategoryRepository;
use Illuminate\Support\Facades\Artisan;

class ArticaleController extends Controller
{
    protected $categoryModel;

    protected $articaleModel;
    public function __construct()
    {
        $this->categoryModel = new CategoryRepository;
        $this->articaleModel = new ArticaleRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryModel->index();
        $categories = $categories->shuffle()
                    ->prepend(new Category(["id" => null,"name" => "-- Please Select A Category"]));
        $articale = $this->articaleModel->index();

        return view('articale.index',[
            'articales' => $articale,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticaleRequest $articaleRequest,ArticaleRepository $articaleRepository)
    {
        try{
            $articaleRequest->validated();
            
            $articaleRepository->store($articaleRequest);
            
            return redirect()->route('articale.index');
        }catch(Exception $e){
            return "{$e->getMessage()} : {$e->getCode()}";
        }
        
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function test()
    {
        /**
         * Eloquent Magic method
         */
        $articale = Articale::whereTitle("Doloremque illu of")
                            ->orWhere('category_id',3)
                            ->whereYear('created_at', "=", date('Y'))
                            ->first();
        if(!$articale) abort(404); // alternative fistOrFail

        /**
         * Put bracket in a sql statement
         */

        $articaleByCategoryAndTimestamp = Articale::where('category_id',3)
                                            ->where(function($query){
                                                $query->whereYear('created_at', 2018)
                                                ->orwhereYear('updated_at', 2018);
                                                return $query;
                                            })
                                            ->get();

        /**
         * Using scope
         */
        $getLetestAtrical = Articale::getNewest($days = 20)->get();

        return $getLetestAtrical;
    }


    public function articaleCollection()
    {
        $articales = $this->articaleModel->index();

        // $firstArticale = $articales->first();

        $articales_collect = $articales->filter(function($articale){
            return $articale->category_id === 3;
        });

        $articaleGroup = $articales->chunk(3)->map(function($articale){
            return $articale->map(function($articale){
                return ["title" => $articale->title, "id" => $articale->id];
            });
        });

    //    echo $articales->sum('id');
    //    echo $articales->avg('id');
    //    echo $articales->max('id');
    //    echo $articales->min('id');
    //    print_r($articales->mode('id'));
    
        // dd($articales_coll);

        return $articales;
    }

    public function articaleFilter(AtricateServices $articaleService)
    {
        $articale = $articaleService->getFilterArticale();
        return $articale;
    }
}
