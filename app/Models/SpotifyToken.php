<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpotifyToken extends Model
{
    use HasFactory;
    protected $fillable = [
        'token',
        'user',
        'authToken',
        'refreshToken'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
