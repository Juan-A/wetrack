<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'spotify_id',
        'review',
        'calification'
    ];
    /**
     * Get the user that owns the Review
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    } 
    /**
     * Get the track that owns the Review
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class, 'spotify_id','spotify_id');
    }
}


