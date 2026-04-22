<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TravelIdea;
use Illuminate\Support\Facades\Auth;
use App\Services\ApiService;
use App\Http\Requests\StoreTravelIdeaRequest;

class TravelIdeaController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    private function renderTravelIdeas($travelIdeas, Request $request)
    {
        if ($request->ajax()) {
            return view('travel_ideas.partials.search_results', compact('travelIdeas'))->render();
        }
        return view('travel_ideas.index', compact('travelIdeas'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $travelIdeas = TravelIdea::withCount('comments')->paginate(5);
        return $this->renderTravelIdeas($travelIdeas, $request);
    }

    public function search(Request $request)
    {
        $query = TravelIdea::query();
        if ($request->has('q') && $request->q != '') {
            $searchTerm = '%' . $request->q . '%';
            $query->where('title', 'LIKE', $searchTerm)
                ->orWhere('destination', 'LIKE', $searchTerm)
                ->orWhere('tags', 'LIKE', $searchTerm)
                ->orWhere('description', 'LIKE', $searchTerm);
        }
        $travelIdeas = $query->withCount('comments')->paginate(5);
        return $this->renderTravelIdeas($travelIdeas, $request);
    }

    public function advancedSearch(Request $request)
    {
        $query = TravelIdea::query();
        $hasSearch = false;

        if ($request->filled('title')) {
            $query->where('title', 'LIKE', '%' . $request->title . '%');
            $hasSearch = true;
        }
        if ($request->filled('destination')) {
            $query->where('destination', 'LIKE', '%' . $request->destination . '%');
            $hasSearch = true;
        }
        if ($request->filled('tags')) {
            $query->where('tags', 'LIKE', '%' . $request->tags . '%');
            $hasSearch = true;
        }
        if ($request->filled('budget_max')) {
            $query->where('budget', '<=', $request->budget_max);
            $hasSearch = true;
        }

        $travelIdeas = $hasSearch ? $query->withCount('comments')->paginate(5) : collect([]);

        return view('travel_ideas.advanced_search', compact('travelIdeas', 'hasSearch'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('travel_ideas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTravelIdeaRequest $request)
    {
        TravelIdea::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'destination' => $request->destination,
            'budget' => $request->budget,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'tags' => $request->tags,
            'image_url' => $request->image_url,
        ]);

        return redirect()->route('travel-ideas.index')
                         ->with('success', 'Travel Idea created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $travelIdea = TravelIdea::findOrFail($id);
        
        // Fetch API Data
        $weather = $this->apiService->getWeather($travelIdea->destination);
        $countryInfo = $this->apiService->getDestinationInfo($travelIdea->destination);
        $aviationData = $this->apiService->getAviationWeatherData($travelIdea->destination);

        return view('travel_ideas.show', compact('travelIdea', 'weather', 'countryInfo', 'aviationData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $travelIdea = TravelIdea::findOrFail($id);
        if ($this->checkOwnership($travelIdea)) return $this->checkOwnership($travelIdea);

        return view('travel_ideas.edit', compact('travelIdea'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTravelIdeaRequest $request, $id)
    {
        $travelIdea = TravelIdea::findOrFail($id);
        if ($this->checkOwnership($travelIdea)) return $this->checkOwnership($travelIdea);

        $travelIdea->update($request->all());

        return redirect()->route('travel-ideas.index')
                         ->with('success', 'Travel Idea updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $travelIdea = TravelIdea::findOrFail($id);
        if ($this->checkOwnership($travelIdea)) return $this->checkOwnership($travelIdea);

        $travelIdea->delete();

        return redirect()->route('travel-ideas.index')
                         ->with('success', 'Travel Idea deleted successfully.');
    }

    /**
     * Check if the authenticated user owns the travel idea.
     */
    private function checkOwnership(TravelIdea $travelIdea)
    {
        if ($travelIdea->user_id !== Auth::id()) {
            return redirect()->route('travel-ideas.index')->with('error', 'Unauthorized access.');
        }
        return false;
    }

    /**
     * Show hotels for a specific travel idea destination using API.
     */
    public function hotels($id)
    {
        $travelIdea = TravelIdea::findOrFail($id);
        $hotels = $this->apiService->getHotels($travelIdea->destination);
        return view('travel_ideas.hotels', compact('travelIdea', 'hotels'));
    }
}
