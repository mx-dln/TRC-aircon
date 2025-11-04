<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProgressRequest;
use App\Http\Requests\UpdateProgressRequest;
use App\Http\Resources\ProgressResource;
use App\Models\Client;
use App\Models\Progress;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProgressController extends Controller
{
    /**
     * Display a listing of the progress entries for a client.
     */
    public function index(Client $client, Request $request): AnonymousResourceCollection
    {
        $query = $client->progress()->getQuery();

        // Filter by status
        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        // Search by title or description
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Pagination
        $perPage = $request->query('per_page', 15);
        $progress = $query->latest()->paginate($perPage);

        return ProgressResource::collection($progress);
    }

    /**
     * Store a newly created progress entry in storage.
     */
    public function store(Client $client, StoreProgressRequest $request): JsonResponse
    {
        $progress = DB::transaction(function () use ($client, $request) {
            $progress = $client->progress()->create($request->validated());
            
            // If status is completed, set completed_at
            if ($request->status === 'completed' && !$request->has('completed_at')) {
                $progress->update(['completed_at' => now()]);
            }
            
            return $progress->load('assignedUser');
        });

        return response()->json([
            'message' => 'Progress entry created successfully',
            'data' => new ProgressResource($progress)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified progress entry.
     */
    public function show(Client $client, Progress $progress): JsonResponse
    {
        // Ensure the progress belongs to the specified client
        if ($progress->client_id !== $client->id) {
            return response()->json(['message' => 'Progress entry not found for this client'], 404);
        }
        
        return response()->json([
            'data' => new ProgressResource($progress->load('assignedUser'))
        ]);
    }

    /**
     * Update the specified progress entry in storage.
     */
    public function update(UpdateProgressRequest $request, Client $client, Progress $progress): JsonResponse
    {
        $progress = DB::transaction(function () use ($request, $progress) {
            $progress->update($request->validated());
            
            // If status is changed to completed, set completed_at if not already set
            if ($request->status === 'completed' && !$progress->completed_at) {
                $progress->update(['completed_at' => now()]);
            }
            
            // If status is changed from completed, clear completed_at
            if ($request->status !== 'completed' && $progress->completed_at) {
                $progress->update(['completed_at' => null]);
            }
            
            return $progress->load('assignedUser');
        });

        return response()->json([
            'message' => 'Progress entry updated successfully',
            'data' => new ProgressResource($progress)
        ]);
    }
}
