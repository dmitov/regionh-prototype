<?php

namespace App\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class PhraseUpdated extends ShouldBeStored
{
    /** @var array */
    public $phraseAttributes;

    public function __construct(array $phraseAttributes)
    {
        $this->phraseAttributes = $phraseAttributes;
    }
}
