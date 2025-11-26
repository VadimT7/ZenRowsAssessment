<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Configuration Model
 * 
 * Represents a saved pairing of an Origin and Destination.
 * This is the core entity customers create when selecting their
 * scraping configuration.
 */
class Configuration extends Model
{
    use HasFactory;

    protected $fillable = [
        'origin_id',
        'destination_id',
    ];

    /**
     * Get the origin for this configuration.
     */
    public function origin(): BelongsTo
    {
        return $this->belongsTo(Origin::class);
    }

    /**
     * Get the destination for this configuration.
     */
    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}

