@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center pr-3">
                    {{ __('Phrases') }}

                    <a href="{{ route('phrases.create') }}" class="btn btn-outline-success">Create</a>
                </div>

                <div class="card-body p-0">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Content</th>
                                <th scope="col">Created</th>
                                <th scope="col">Updated</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($phrases as $phrase)
                                <tr>
                                    <th scope="row">{{ $phrase->uuid }}</th>
                                    <td>{{ substr(strip_tags($phrase->content), 0, 50) }}</td>
                                    <td>{{ $phrase->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $phrase->updated_at->format('Y-m-d') }}</td>
                                    <td class="text-right pr-3">
                                        <a href="/phrases/{{$phrase->uuid}}/edit" class="btn btn-outline-primary">Edit</a>
                                        <form method="POST" action="/phrases/{{$phrase->uuid}}" class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <input type="submit" class="btn btn-outline-danger" value="Delete">
                                        </form>
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
@endsection
