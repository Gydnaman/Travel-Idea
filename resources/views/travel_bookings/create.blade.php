@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Book Your Travel Adventure</div>
                <div class="card-body">
                    <p class="text-muted">Fill in the details below to request a booking.</p>
                    
                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', Auth::user()->name ?? '') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Minimum 6 alphanumeric characters.</small>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <div class="input-group">
                                <select name="country_code" class="form-select bg-light" style="max-width: 130px;" required>
                                    <option value="+86" {{ old('country_code') == '+86' ? 'selected' : '' }}>+86 (CN)</option>
                                    <option value="+852" {{ old('country_code') == '+852' ? 'selected' : '' }}>+852 (HK)</option>
                                    <option value="+1" {{ old('country_code') == '+1' ? 'selected' : '' }}>+1 (US/CA)</option>
                                    <option value="+44" {{ old('country_code') == '+44' ? 'selected' : '' }}>+44 (UK)</option>
                                    <option value="+81" {{ old('country_code') == '+81' ? 'selected' : '' }}>+81 (JP)</option>
                                </select>
                                <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Phone Number" required>
                            </div>
                            @error('phone')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                            @error('country_code')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', Auth::user()->email ?? '') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="item_name" class="form-label">Travel Package/Idea Name</label>
                            <input type="text" name="item_name" id="item_name" class="form-control @error('item_name') is-invalid @enderror" value="{{ old('item_name', request('item')) }}" required>
                            @error('item_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="booking_date" class="form-label">Preferred Booking Date</label>
                            <input type="date" name="booking_date" id="booking_date" class="form-control @error('booking_date') is-invalid @enderror" value="{{ old('booking_date') }}" required>
                            @error('booking_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">Submit Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
