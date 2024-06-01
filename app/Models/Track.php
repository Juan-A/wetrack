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
        'json',
        'description'
    ];
    protected $casts = [
        'json' => 'array',
    ];
    protected $primaryKey = 'spotify_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'spotify_id', 'spotify_id');
    }
}
