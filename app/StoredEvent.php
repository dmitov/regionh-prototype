<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent;

class StoredEvent extends EloquentStoredEvent
{
    public static function boot()
    {
        parent::boot();

        static::creating(function(StoredEvent $storedEvent) {
            $storedEvent->meta_data['user_id'] = auth()->user()->id;
        });
    }

    public function scopeVersion(Builder $query, int $version): void
    {
        $query->where('aggregate_version', $version);
    }
}
