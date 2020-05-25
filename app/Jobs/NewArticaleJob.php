<?php

namespace App\Jobs;

use App\User;
use Exception;
use App\Articale;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\ArticaleNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ArticaleAuthorNotification;

class NewArticaleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $articale;
    public function __construct(Articale $articale)
    {
        $this->articale = $articale;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        $allUser = User::all();
        Notification::send($allUser, new ArticaleNotification($this->articale));
    }

    public function failed(Exception $exception)
    {
        info($exception->getMessage());
    }
}
