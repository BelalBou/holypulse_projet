<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VerseLike;
use Illuminate\Support\Facades\DB;

class VerseLikeController extends Controller
{
    public function toggle(Request $request, $verseId)
    {
        $user = $request->user();
    
        if (!$user) {
            return response()->json(['error' => 'Utilisateur non authentifié'], 401);
        }
    
        $like = VerseLike::where('user_id', $user->id)
                         ->where('verse_id', $verseId)
                         ->first();
    
        if ($like) {
            $like->delete();
            return response()->json(['liked' => false]);
        } else {
            VerseLike::create([
                'user_id' => $user->id,
                'verse_id' => $verseId
            ]);
            return response()->json(['liked' => true]);
        }
    }
    

    public function index(Request $request)
    {
        $user = $request->user();
    
        if (!$user) {
            return response()->json(['error' => 'Utilisateur non authentifié'], 401);
        }
    
        $likes = $user->verseLikes()->pluck('verse_id');
    
        return response()->json($likes);
    }
    public function likedVerses(Request $request)
    {
        $user = $request->user();
        
        if (!$user) {
            return response()->json(['error' => 'Utilisateur non authentifié'], 401);
        }

        $likedVerses = DB::table('verse_likes')
            ->join('bible_verses_segond_1910', 'verse_likes.verse_id', '=', 'bible_verses_segond_1910.id')
            ->where('verse_likes.user_id', $user->id)
            ->select('bible_verses_segond_1910.*')
            ->orderBy('verse_likes.created_at', 'desc')
            ->get();

        return response()->json($likedVerses);
    }

    
}
