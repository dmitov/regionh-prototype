<?php

namespace App\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class PhraseDeleted extends ShouldBeStored
{
    /** @var string */
    public $phraseUuid;

    public function __construct(string $phraseUuid)
    {
        $this->phraseUuid = $phraseUuid;
    }
}
