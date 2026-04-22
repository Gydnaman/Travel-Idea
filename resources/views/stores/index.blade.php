@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Our Travel Agencies & Partners</h1>
    
    <div class="row mb-5">
        @foreach($photos as $photo)
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0">
                <img src="{{ asset('Images/photos/' . $photo) }}" class="card-img-top" alt="Travel Photo" onerror="this.src='https://via.placeholder.com/400x300?text={{ $photo }}'">
            </div>
        </div>
        @endforeach
    </div>

    <div class="row">
        @forelse($stores as $store)
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $store->store_name }}</h5>
                    <p class="card-text"><strong>Address:</strong> {{ $store->store_address }}</p>
                    <p class="card-text"><strong>Tel:</strong> {{ $store->tel_no }}</p>
                    @if($store->email)
                    <p class="card-text"><strong>Email:</strong> {{ $store->email }}</p>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <div class="alert alert-info">No agencies found in the database.</div>
        </div>
        @endforelse
    </div>
</div>
@endsection
