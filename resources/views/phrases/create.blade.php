@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center pr-3">
                    {{ __('Create Phrase') }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="tab-pane fade show active" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                        @include('phrases._form', [
                            'method' => 'POST',
                            'action' => route('phrases.store'),
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
