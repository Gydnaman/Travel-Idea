@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Advanced Search</div>
                <div class="card-body">
                    <form action="{{ route('travel-ideas.advanced-search') }}" method="GET">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ request('title') }}">
                        </div>
                        <div class="mb-3">
                            <label for="destination" class="form-label">Destination</label>
                            <input type="text" name="destination" id="destination" class="form-control" value="{{ request('destination') }}">
                        </div>
                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags</label>
                            <input type="text" name="tags" id="tags" class="form-control" value="{{ request('tags') }}">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Find Ideas</button>
                    </form>
                </div>
            </div>

            @if($hasSearch)
                <div id="advanced-results">
                    <h3>Search Results</h3>
                    @include('travel_ideas.partials.search_results')
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
