<?php

namespace App\Http\Controllers;

use App\Models\Origin;
use Illuminate\Http\JsonResponse;

/**
 * OriginController
 * 
 * Handles API requests for origin data.
 * Currently read-only as origins are pre-configured.
 * Can be extended later to support custom origins.
 */
class OriginController extends Controller
{
    /**
     * Get all available origins.
     * Returns the list of scraping source websites.
     */
    public function index(): JsonResponse
    {
        $origins = Origin::all();
        
        return response()->json([
            'data' => $origins,
            'message' => 'Origins retrieved successfully',
        ]);
    }
}

