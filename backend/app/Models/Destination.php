<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Destination Model
 * 
 * Represents a data destination where scraped data will be sent 
 * (e.g., Amazon S3, PostgreSQL).
 * Destinations are pre-configured and loaded via database seeding.
 */
class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'color',
    ];

    /**
     * Get all configurations that use this destination.
     * Useful for future extensions like cascade operations.
     */
    public function configurations(): HasMany
    {
        return $this->hasMany(Configuration::class);
    }
}

