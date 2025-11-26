<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Origin Model
 * 
 * Represents a website source that can be scraped (e.g., Zillow, Redfin).
 * Origins are pre-configured and loaded via database seeding.
 */
class Origin extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'color',
    ];

    /**
     * Get all configurations that use this origin.
     * Useful for future extensions like cascade operations.
     */
    public function configurations(): HasMany
    {
        return $this->hasMany(Configuration::class);
    }
}

