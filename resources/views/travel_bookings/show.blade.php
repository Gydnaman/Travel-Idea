@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0 fw-bold">Booking Details #{{ $booking->id }}</h5>
                </div>
                <div class="card-body p-4 bg-light">
                    <div class="bg-white p-4 rounded-3 shadow-sm mb-4">
                        <div class="row mb-3 border-bottom pb-2">
                            <div class="col-sm-4 text-muted fw-bold">Customer Name</div>
                            <div class="col-sm-8">{{ $booking->name }}</div>
                        </div>
                        <div class="row mb-3 border-bottom pb-2">
                            <div class="col-sm-4 text-muted fw-bold">Email Address</div>
                            <div class="col-sm-8"><a href="mailto:{{ $booking->email }}">{{ $booking->email }}</a></div>
                        </div>
                        <div class="row mb-3 border-bottom pb-2">
                            <div class="col-sm-4 text-muted fw-bold">Phone Number</div>
                            <div class="col-sm-8">{{ $booking->phone }}</div>
                        </div>
                        <div class="row mb-3 border-bottom pb-2">
                            <div class="col-sm-4 text-muted fw-bold">Travel Package / Idea</div>
                            <div class="col-sm-8 text-primary fw-bold">{{ $booking->item_name }}</div>
                        </div>
                        <div class="row mb-3 border-bottom pb-2">
                            <div class="col-sm-4 text-muted fw-bold">Preferred Booking Date</div>
                            <div class="col-sm-8">{{ $booking->booking_date }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted fw-bold">Request Created At</div>
                            <div class="col-sm-8">{{ $booking->created_at->format('Y-m-d H:i:s') }}</div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end mb-4">
                        <a href="{{ route('bookings.index') }}" class="btn btn-outline-secondary px-4 py-2">
                            <i class="bi bi-arrow-left me-2"></i>Back to Requests
                        </a>
                    </div>
                    
                    @if(isset($hotels) && count($hotels) > 0)
                        <div class="mt-5">
                            <h4 class="fw-bold mb-4 border-bottom pb-2 text-primary">
                                <i class="bi bi-building me-2"></i>Recommended Hotels via Makcorps API
                                <br><small class="text-muted fs-6" style="font-weight: normal;">Based on your destination: {{ $booking->item_name }}</small>
                            </h4>
                            <div class="row g-4">
                                @foreach($hotels as $hotel)
                                    <div class="col-md-4">
                                        <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden" style="transition: transform 0.2s;">
                                            <img src="{{ $hotel['image'] }}" class="card-img-top" alt="{{ $hotel['name'] }}" style="height: 180px; object-fit: cover;">
                                            <div class="card-body position-relative">
                                                <div class="position-absolute top-0 end-0 bg-primary text-white px-3 py-1 rounded-start shadow-sm" style="margin-top: -15px;">
                                                    <i class="bi bi-star-fill text-warning me-1"></i> {{ $hotel['rating'] }}
                                                </div>
                                                <h5 class="card-title fw-bold text-dark mb-1">{{ $hotel['name'] }}</h5>
                                                <p class="text-muted mb-3 small"><i class="bi bi-shop me-1"></i> {{ $hotel['vendor'] ?? 'Partner OTA' }}</p>
                                                <div class="d-flex justify-content-between align-items-center mt-3">
                                                    <span class="fs-5 fw-bold text-success">{{ $hotel['price'] }}</span>
                                                    @php 
                                                        $vendorName = $hotel['vendor'] ?? 'our partner'; 
                                                        $hotelName = $hotel['name'];
                                                    @endphp
                                                    <button onclick="alert('Redirecting to {{ addslashes($vendorName) }} to complete your booking for {{ addslashes($hotelName) }}...')" class="btn btn-sm btn-outline-primary rounded-pill px-3">Booking Now</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
