<?php

namespace App\Http\Controllers;

use App\Aggregates\PhraseAggregate;
use App\Phrase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PhrasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phrases = Phrase::all();

        return view('phrases.index', compact('phrases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('phrases.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newUuid = Str::uuid()->toString();

        $data = $request->only(['metadata', 'content']);
        $data['user_id'] = Auth::id();

        $phrase = PhraseAggregate::retrieve($newUuid)
            ->createPhrase($data)
            ->persist();

        return redirect()->route('phrases.edit', ['phrase' => $phrase->uuid()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show(string $uuid)
    {
        //
    }

    /**
     * Display the specified versioned resource.
     *
     * @param  string  $uuid
     * @param  int  $version
     * @return \Illuminate\Http\Response
     */
    public function showVersion(string $uuid, int $version)
    {
        $aggregate = PhraseAggregate::retrieve($uuid);
        $event = $aggregate->getAppliedEvents()[$version - 1];

        $phraseAttributes = $event->phraseAttributes;
        $phraseAttributes['uuid'] = $aggregate->uuid();

        $phrase = new Phrase($phraseAttributes);

        return view('phrases.edit', compact('phrase', 'version'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit(string $uuid)
    {
        $phrase = Phrase::with('events')->where('uuid', $uuid)->first();

        return view('phrases.edit', compact('phrase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $uuid)
    {
        $data = $request->only(['metadata', 'content']);

        $phrase = PhraseAggregate::retrieve($uuid)
            ->updatePhrase($data)
            ->persist();

        return redirect()->route('phrases.edit', ['phrase' => $phrase->uuid()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $uuid)
    {
        $phrase = PhraseAggregate::retrieve($uuid)
            ->deletePhrase()
            ->persist();

        return redirect()->route('phrases.index');
    }
}
