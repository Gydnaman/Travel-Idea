<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\TravelIdea;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request, $travelIdeaId)
    {
        $validated = $request->validate([
            'rating' => 'nullable|integer|min:1|max:5',
            'content' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $travelIdea = TravelIdea::findOrFail($travelIdeaId);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'travel_idea_id' => $travelIdea->id,
            'rating' => $validated['rating'] ?? 0,
            'content' => htmlspecialchars($validated['content'], ENT_QUOTES, 'UTF-8'),
            'parent_id' => $validated['parent_id'] ?? null,
        ]);

        if ($request->ajax()) {
            $comment->load('user');
            $comment->likes_count = 0;
            $comment->dislikes_count = 0;
            $comment->user_liked = false;
            $comment->user_disliked = false;
            return response()->json([
                'success' => true,
                'comment' => $comment,
                'human_date' => $comment->created_at->diffForHumans()
            ]);
        }

        return redirect()->route('travel-ideas.show', $travelIdea->id)->with('success', 'Your review has been successfully submitted!');
    }

    public function toggleInteraction(Request $request, $id)
    {
        $request->validate(['type' => 'required|in:like,dislike']);
        
        $comment = Comment::findOrFail($id);
        $user_id = Auth::id();

        $existing = \App\Models\CommentInteraction::firstOrNew([
            'user_id' => $user_id,
            'comment_id' => $comment->id,
        ]);

        if ($existing->exists && $existing->type === $request->type) {
            $existing->delete();
        } else {
            $existing->type = $request->type;
            $existing->save();
        }

        $likes = $comment->interactions()->where('type', 'like')->count();
        $dislikes = $comment->interactions()->where('type', 'dislike')->count();

        return response()->json([
            'success' => true,
            'likes' => $likes,
            'dislikes' => $dislikes
        ]);
    }

    /**
     * Fetch latest comments for AJAX polling
     */
    public function fetchLatest(Request $request, $travelIdeaId)
    {
        $lastCommentId = $request->query('last_comment_id', 0);
        $userId = Auth::id();

        $comments = Comment::with('user')
            ->with(['interactions' => function($q) use ($userId) { 
                $q->where('user_id', $userId); 
            }])
            ->withCount([
                'interactions as likes_count' => function ($query) { $query->where('type', 'like'); },
                'interactions as dislikes_count' => function ($query) { $query->where('type', 'dislike'); }
            ])
            ->where('travel_idea_id', $travelIdeaId)
            ->where('id', '>', $lastCommentId)
            ->oldest() // Ascending order
            ->get()
            ->map(function ($comment) {
                $comment->human_date = $comment->created_at->diffForHumans();
                $userAction = $comment->interactions->first();
                $comment->user_liked = $userAction && $userAction->type === 'like';
                $comment->user_disliked = $userAction && $userAction->type === 'dislike';
                // Don't send entire interactions array to frontend
                unset($comment->interactions);
                return $comment;
            });

        return response()->json([
            'success' => true,
            'comments' => $comments
        ]);
    }
}
