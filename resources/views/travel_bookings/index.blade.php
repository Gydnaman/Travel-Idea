@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Booking Requests</h1>
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Item</th>
                            <th>Date</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->email }}</td>
                            <td>{{ $booking->item_name }}</td>
                            <td>{{ $booking->booking_date }}</td>
                            <td>{{ $booking->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <a href="{{ route('bookings.show', $booking->id) }}" class="btn action-btn btn-sm btn-info text-white">View</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No bookings found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
