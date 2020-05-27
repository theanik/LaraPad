<?php
namespace App\Repository;

use App\User;
use App\Articale;
use App\Jobs\NewArticaleJob;
use App\Notifications\ArticaleAuthorNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Notifications\ArticaleNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ArticaleRepository
{
    public function index()
    {
        $articale = Cache::get('articale', []);
        if(!$articale){
            $articale = Articale::with('category')->get();
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
        // testing traits
        $articale->fileUpload("hello.png");
        $articale->save();
        auth()->user()->notify(new ArticaleAuthorNotification($articale));
        NewArticaleJob::dispatch($articale);
        return $articale;
    }


}