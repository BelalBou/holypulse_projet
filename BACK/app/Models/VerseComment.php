<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerseComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'verse_id',
        'content',
    ];

    // Relation inverse : un commentaire appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
