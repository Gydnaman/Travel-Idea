@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-0"><i class="bi bi-building"></i> Local Hotels in {{ $travelIdea->destination }}</h2>
            <p class="text-muted mb-0 mt-1">Sourced via Makcorps Hotel API</p>
        </div>
        <a href="{{ route('travel-ideas.show', $travelIdea->id) }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back to Idea
        </a>
    </div>

    @if(isset($hotels) && count($hotels) > 0)
        <div class="row g-4">
            @foreach($hotels as $hotel)
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden" style="transition: transform 0.2s;">
                        <img src="{{ $hotel['image'] }}" class="card-img-top" alt="{{ $hotel['name'] }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body position-relative">
                            <div class="position-absolute top-0 end-0 bg-primary text-white px-3 py-1 rounded-start shadow-sm" style="margin-top: -15px;">
                                <i class="bi bi-star-fill text-warning me-1"></i> {{ $hotel['rating'] }}
                            </div>
                            <h5 class="card-title fw-bold text-dark mb-1">{{ $hotel['name'] }}</h5>
                            <p class="text-muted mb-3 small"><i class="bi bi-shop me-1"></i> Provided by {{ $hotel['vendor'] ?? 'Partner' }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <span class="fs-4 fw-bold text-success">{{ $hotel['price'] }}</span>
                                @php 
                                    $vendorName = $hotel['vendor'] ?? 'partner'; 
                                    $hotelName = $hotel['name'];
                                @endphp
                                <button onclick="alert('Redirecting to {{ addslashes($vendorName) }} to complete your booking for {{ addslashes($hotelName) }}...')" class="btn btn-outline-primary rounded-pill px-4">Booking Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <div class="display-1 text-muted mb-3"><i class="bi bi-emoji-frown"></i></div>
            <h4 class="text-muted">No hotels found in this area.</h4>
            <p>We couldn't retrieve hotel data for {{ $travelIdea->destination }}. Please check back later.</p>
        </div>
    @endif
</div>
@endsection
