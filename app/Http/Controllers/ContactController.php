<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $stores = Contact::all();
        // Placeholder photos
        $photos = ['travel1.jpg', 'travel2.jpg', 'travel3.jpg'];

        return view('stores.index', compact('stores', 'photos'));
    }
}
