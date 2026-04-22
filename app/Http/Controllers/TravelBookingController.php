<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TravelBooking;
use App\Services\ApiService;

class TravelBookingController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        // Enforce user authentication for all TravelBooking module actions
        $this->middleware('auth');
        $this->apiService = $apiService;
    }

    public function index()
    {
        $bookings = TravelBooking::latest()->get();
        return view('travel_bookings.index', compact('bookings'));
    }

    public function create()
    {
        return view('travel_bookings.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|alpha_num|min:6',
            'country_code' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'item_name' => 'required|string',
            'booking_date' => 'required|date',
        ]);

        $validatedData['phone'] = $validatedData['country_code'] . ' ' . $validatedData['phone'];
        unset($validatedData['country_code']);

        TravelBooking::create($validatedData);

        return redirect()->route('bookings.index')->with('success', 'Travel booking requested successfully!');
    }

    public function show($id)
    {
        $booking = TravelBooking::findOrFail($id);
        
        // Use the requested tracking item name as destination reference for the Hotel API
        $hotels = $this->apiService->getHotels($booking->item_name);
        
        return view('travel_bookings.show', compact('booking', 'hotels'));
    }
}
