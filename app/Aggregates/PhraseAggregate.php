<?php

namespace App\Aggregates;

use App\Events\PhraseCreated;
use App\Events\PhraseDeleted;
use App\Events\PhraseUpdated;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class PhraseAggregate extends AggregateRoot
{
    public function createPhrase(array $attributes)
    {
        $this->recordThat(new PhraseCreated($attributes));

        return $this;
    }

    public function updatePhrase(array $attributes)
    {
        $this->recordThat(new PhraseUpdated($attributes));

        return $this;
    }

    public function deletePhrase()
    {
        $this->recordThat(new PhraseDeleted($this->uuid()));

        return $this;
    }
}
