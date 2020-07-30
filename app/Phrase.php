<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phrase extends Model
{
    protected $guarded = [];

    /*
     * A helper method to quickly retrieve an account by uuid.
     */
    public static function uuid(string $uuid): ?Phrase
    {
        return static::where('uuid', $uuid)->first();
    }


    public function events()
    {
        return $this->hasMany(StoredEvent::class, 'aggregate_uuid', 'uuid');
    }
}
