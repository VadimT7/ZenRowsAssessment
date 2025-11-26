<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\JsonResponse;

/**
 * DestinationController
 * 
 * Handles API requests for destination data.
 * Currently read-only as destinations are pre-configured.
 * Can be extended later to support custom destinations.
 */
class DestinationController extends Controller
{
    /**
     * Get all available destinations.
     * Returns the list of data export targets.
     */
    public function index(): JsonResponse
    {
        $destinations = Destination::all();
        
        return response()->json([
            'data' => $destinations,
            'message' => 'Destinations retrieved successfully',
        ]);
    }
}

