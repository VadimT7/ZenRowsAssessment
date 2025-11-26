<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * ConfigurationController
 * 
 * Handles CRUD operations for configuration pairs (origin + destination).
 * Supports the bonus feature of multiple saved configurations.
 */
class ConfigurationController extends Controller
{
    /**
     * Get all saved configurations with their related origin and destination.
     * Eager loads relationships to avoid N+1 queries.
     */
    public function index(): JsonResponse
    {
        $configurations = Configuration::with(['origin', 'destination'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return response()->json([
            'data' => $configurations,
            'message' => 'Configurations retrieved successfully',
        ]);
    }

    /**
     * Store a new configuration pair.
     * Validates that origin and destination IDs exist.
     * Prevents duplicate configurations via database constraint.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'origin_id' => ['required', 'integer', 'exists:origins,id'],
            'destination_id' => ['required', 'integer', 'exists:destinations,id'],
        ]);

        // Check if this exact combination already exists
        $existing = Configuration::where('origin_id', $validated['origin_id'])
            ->where('destination_id', $validated['destination_id'])
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'This configuration pair already exists',
                'data' => $existing->load(['origin', 'destination']),
            ], 409);
        }

        $configuration = Configuration::create($validated);
        $configuration->load(['origin', 'destination']);

        return response()->json([
            'data' => $configuration,
            'message' => "You saved {$configuration->origin->name} and {$configuration->destination->name}.",
        ], 201);
    }

    /**
     * Delete a configuration by ID.
     * Returns 404 if configuration doesn't exist.
     */
    public function destroy(int $id): JsonResponse
    {
        $configuration = Configuration::find($id);

        if (!$configuration) {
            return response()->json([
                'message' => 'Configuration not found',
            ], 404);
        }

        $configuration->delete();

        return response()->json([
            'message' => 'Configuration deleted successfully',
        ]);
    }
}

