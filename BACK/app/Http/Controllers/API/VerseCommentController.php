<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VerseComment;

use Illuminate\Support\Facades\DB;

class VerseCommentController extends Controller
{
    // Affiche les commentaires d’un verset
    public function index($verseId)
    {
        $comments = VerseComment::where('verse_id', $verseId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($comments);
    }

    public function commentedVerses(Request $request)
    {
        $user = $request->user();
        
        if (!$user) {
            return response()->json(['error' => 'Utilisateur non authentifié'], 401);
        }

        $commentedVerses = DB::table('verse_comments')
            ->join('bible_verses_segond_1910', 'verse_comments.verse_id', '=', 'bible_verses_segond_1910.id')
            ->where('verse_comments.user_id', $user->id)
            ->select(
                'verse_comments.id as comment_id',
                'verse_comments.content',
                'bible_verses_segond_1910.book',
                'bible_verses_segond_1910.chapter',
                'bible_verses_segond_1910.verse',
                'bible_verses_segond_1910.text')
            ->orderBy('verse_comments.created_at', 'desc')
            ->get();

        return response()->json($commentedVerses);
    }


    // Crée un nouveau commentaire
    public function store(Request $request, $verseId)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'Non authentifié'], 401);
        }

        $validated = $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment = VerseComment::create([
            'user_id' => $user->id,
            'verse_id' => $verseId,
            'content' => $validated['content'],
        ]);

        return response()->json($comment, 201);
    }

}
