<?php

namespace App\Listeners;

use App\Events\DoAction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use \App\Activity;

class SaveActionOnActivityTable
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DoAction  $event
     * @return void
     */
    public function handle(DoAction $event)
    {
        dd($event);
        Activity::record('create', $event->user);
        /*
        if  (get_class($event->user) != 'Activiy') {
            Activity::store(DoAction $event);
        }    */
        
    }
}
