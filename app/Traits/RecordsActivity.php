<?php

namespace App\Traits;

use App\Activity;

trait RecordsActivity
{

    // Naming convention boot{name_of_trait}. auto detected by Laravel
    protected static function bootRecordsActivity()
    {
        if(auth()->guest()) return;

        foreach(static::getActivitiesToRecord() as $event) {
            static::$event(function($model) use ($event) {
                $model->recordActivity($event);
            });
        }
    }

    protected static function getActivitiesToRecord()
    {
        // default to created event. We may want to record other events like deleted, updated for some models
        // example, record activity when a thread is created and deleted
        // but only record activity when a reply is created
        return ['created'];
    }

    protected function recordActivity($event)
    {
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type' => $this->getActivityType($event)
        ]);
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    protected function getActivityType($event)
    {
        //return $event . '_' . strtolower((new \ReflectionClass($this))->getShortName());

        return $event;
    }
}
