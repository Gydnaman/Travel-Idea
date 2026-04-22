<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TravelIdea;

class WelcomeController extends Controller
{
    public function index()
    {
        // Fetch 3 random travel ideas from the database
        $randomIdeas = TravelIdea::inRandomOrder()->take(3)->get();

        return view('welcome', compact('randomIdeas'));
    }
}
