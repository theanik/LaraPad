<?php

namespace App\Observers;

use App\Articale;
use Illuminate\Support\Facades\Cache;

class ArticaleObserver
{    
    /**
     * creating
     *
     * @return void
     */

    public function creating(Articale $articale)
    {
        $articale->created_by = auth()->id();
    }
    /**
     * Handle the articale "created" event.
     *
     * @param  \App\Articale  $articale
     * @return void
     */
    public function created(Articale $articale)
    {
        $this->clearCache();
    }

    /**
     * Handle the articale "updated" event.
     *
     * @param  \App\Articale  $articale
     * @return void
     */
    public function updated(Articale $articale)
    {
        //
    }

    /**
     * Handle the articale "deleted" event.
     *
     * @param  \App\Articale  $articale
     * @return void
     */
    public function deleted(Articale $articale)
    {
        //
    }

    /**
     * Handle the articale "restored" event.
     *
     * @param  \App\Articale  $articale
     * @return void
     */
    public function restored(Articale $articale)
    {
        //
    }

    /**
     * Handle the articale "force deleted" event.
     *
     * @param  \App\Articale  $articale
     * @return void
     */
    public function forceDeleted(Articale $articale)
    {
        //
    }

    private function clearCache()
    {
        Cache::forget('articale');
    }
}
