<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HasEventTriggers
{
    protected static function boot()
    {
        parent::boot();
        static::created(function (Model $model) {
            $eventClass = '\\App\\Events\\' . class_basename($model) . 'Changed';
            event(new $eventClass());
        });

        static::updated(function (Model $model) {
            $eventClass = '\\App\\Events\\' . class_basename($model) . 'Changed';
            event(new $eventClass());
        });

        static::deleted(function (Model $model) {
            $eventClass = '\\App\\Events\\' . class_basename($model) . 'Changed';
            event(new $eventClass());
        });
    }
}
