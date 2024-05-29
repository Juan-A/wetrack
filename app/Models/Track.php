<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Track extends Model
{
    use HasFactory;
    /**
     * Get all of the reviews for the Track
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $fillable = [
        'spotify_id',
        'name',
        'description'
    ];
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'spotify_id', 'spotify_id');
    }
}
