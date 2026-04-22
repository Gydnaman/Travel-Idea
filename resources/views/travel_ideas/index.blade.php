@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center mb-4">
        <div class="col">
            <h1>Browse Travel Ideas</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('travel-ideas.create') }}" class="btn btn-success">Add New Idea</a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 offset-md-3">
            <div class="input-group">
                <input type="text" id="search" name="q" class="form-control" placeholder="Search by title, destination, or tags..." aria-label="Search">
                <button class="btn btn-primary" type="button" id="search-btn">Search</button>
            </div>
        </div>
    </div>

    <div id="results-container">
        @include('travel_ideas.partials.search_results')
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    function fetchResults(query = '', page = 1) {
        $.ajax({
            url: "{{ route('travel-ideas.search') }}",
            method: 'GET',
            data: { q: query, page: page },
            success: function(data) {
                $('#results-container').html(data);
            }
        });
    }

    $('#search-btn').on('click', function() {
        let query = $('#search').val();
        fetchResults(query);
    });

    $('#search').on('keyup', function(e) {
        if (e.keyCode === 13) {
            let query = $(this).val();
            fetchResults(query);
        }
    });

    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let query = $('#search').val();
        fetchResults(query, page);
    });
});
</script>
@endsection
