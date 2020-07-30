<?php

namespace App\Projectors;

use App\Events\PhraseCreated;
use App\Events\PhraseDeleted;
use App\Events\PhraseUpdated;
use App\Phrase;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class PhraseProjector extends Projector
{
    public function onPhraseCreated(PhraseCreated $event, string $aggregateUuid)
    {
        $data = $event->phraseAttributes;
        $data['uuid'] = $aggregateUuid;

        Phrase::create($data);
    }

    public function onPhraseDeleted(PhraseDeleted $event)
    {
        Phrase::uuid($event->phraseUuid)->delete();
    }

    public function onPhraseUpdated(PhraseUpdated $event, string $aggregateUuid)
    {
        Phrase::where('uuid', $aggregateUuid)->update($event->phraseAttributes);
    }
}
