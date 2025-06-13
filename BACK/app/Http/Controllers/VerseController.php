<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VerseController extends Controller
{
    public function random()
    {
        $verse = DB::table('bible_verses_segond_1910')->inRandomOrder()->first();


        return response()->json($verse);
    }

    public function show($id)
{
    $verse = DB::table('bible_verses_segond_1910')->where('id', $id)->first();

    if (!$verse) {
        return response()->json(['message' => 'Verset introuvable'], 404);
    }

    return response()->json($verse);
}

}
