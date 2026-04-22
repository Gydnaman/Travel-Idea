<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TravelBooking;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        // Fetch history using the user's email matching TravelBooking
        $bookings = TravelBooking::where('email', $user->email)->latest()->get();
        // Fetch comments count for the user
        $comments_count = Comment::where('user_id', $user->id)->count();

        return view('dashboard', compact('bookings', 'comments_count'));
    }
}
