<?php

namespace App\Listeners;

use App\Events\Event;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventListener
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
     * @param  Event  $event
     * @return void
     */
    public function handle(Event $event)
    {
        //dispatch(\App\Jobs\SendReminderEmail($event));
        //dd("hola");
        $job = (new \App\Jobs\SendReminderEmail(\Auth::user()));                
                 //->delay(\Carbon\Carbon::now()->addMinutes(2));

        dispatch($job);
    }
}
