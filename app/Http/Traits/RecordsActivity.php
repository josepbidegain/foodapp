<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

trait RecordsActivityTrait
{
    use SoftDeletes;

    /**
     * $events maps Eloquent events to trait methods.
     */
    protected $events = [
        'created'   =>  'createItem',
        'deleted'   =>  'deleteItem',
        'updating'  =>  'updateItem',
        'saving'    =>  'saveItem',
    ];

    /**
     * Set up event listeners for all Item types.
     * Named events are mapped to trait methods in $events.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        foreach(static::getModelEvents() as $event) {
            static::$event(function($item) use ($event){
                $item = static::$events[$event];
                $item->$action($item);
            });
        }
    }

    /**
     * Retrieve events the model needs listeners for.
     *
     * @return array
     */
    protected static function getModelEvents()
    {
        if (isset(static::$modelEvents)){
            //if a model needs fewer events available to SavesItem, define in that model's $modelEvents array.
            return static::$modelEvents;
        }
        return [
            'created', 'deleted', 'updating', 'saving'
        ];
    }

    public function createItem($item)
    {
        dd($item);
        //runs when created event is dispatched
    }

    public function updateItem($item)
    {
        //runs when updating event is dispatched
    }

    public function saveItem($item)
    {
        //runs when saving event is dispatched
    }

    public function deleteItem($item)
    {
        //runs when deleted event is dispatched
    }

}