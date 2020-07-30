@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center pr-3">
                    {{ __('Edit Phrase') }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit" aria-selected="true">Edit</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="revisions-tab" data-toggle="tab" href="#revisions" role="tab" aria-controls="revisions" aria-selected="false">Revisions</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                            @include('phrases._form', [
                                'method' => 'PUT',
                                'action' => route('phrases.update', $phrase->uuid),
                                'phrase' => $phrase,
                                'disabled' => isset($version),
                            ])
                        </div>
                        <div class="tab-pane fade" id="revisions" role="tabpanel" aria-labelledby="revisions-tab">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Event</th>
                                        <th scope="col">Version</th>
                                        <th scope="col">User ID</th>
                                        <th scope="col">Date</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($phrase->events as $event)
                                        <tr>
                                            <th scope="row">{{ str_replace('App\Events\Phrase', '', $event->event_class) }}</th>
                                            <td>{{ $event->aggregate_version }}</td>
                                            <td>{{ $event->meta_data->user_id }}</td>
                                            <td>{{ $event->created_at }}</td>
                                            <td class="text-right">
                                                @if (! $loop->last)
                                                    <a
                                                        class="btn btn-outline-primary"
                                                        href="{{ route('phrases.version', [
                                                            'uuid' => $phrase->uuid,
                                                            'version' => $event->aggregate_version,
                                                        ]) }}"
                                                    >
                                                        View
                                                    </a>
                                                @else
                                                    <a
                                                        class="btn btn-outline-primary"
                                                        href="{{ route('phrases.edit', $phrase->uuid) }}"
                                                    >
                                                        Edit
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
