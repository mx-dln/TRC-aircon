<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProgressRequest;
use App\Http\Requests\UpdateProgressRequest;
use App\Http\Resources\ProgressResource;
use App\Models\Client;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ProgressController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Display a listing of the progress entries for a client.
     */
    public function index(Client $client, Request $request)
    {
        $query = $client->progress();

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

        return Inertia::render('Progress/Index', [
            'client' => $client,
            'progress' => $progress,
            'filters' => [
                'status' => $status ?? '',
                'search' => $search ?? '',
            ],
        ]);
    }

    /**
     * Show the form for creating a new progress entry.
     */
    public function create(Client $client)
    {
        return Inertia::render('Progress/Create', [
            'client' => $client
        ]);
    }

    /**
     * Store a newly created progress entry in storage.
     */
    public function store(Client $client, StoreProgressRequest $request)
    {
        $data = $request->validated();
        
        $progress = DB::transaction(function () use ($client, $request, $data) {
            // Handle file uploads
            $imagePaths = [];
            
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    if ($image->isValid()) {
                        // Store the file in the public disk under the project-progress directory
                        $path = $image->store('project-progress', 'public');
                        if ($path) {
                            $imagePaths[] = $path;
                        }
                    }
                }
            }
            
            // Store the image paths as a JSON array
            $data['images'] = $imagePaths;
            
            // Create the progress record with the client_id and project_id
            return $client->progress()->create(array_merge($data, [
                'client_id' => $client->id,
                'project_id' => $request->project_id ?? null,
            ]));
        });

        return redirect()
            ->route('clients.progress.show', [$client, $progress])
            ->with('success', 'Progress entry created successfully.');
    }

    /**
     * Display the specified progress entry.
     */
    public function show(Client $client, Progress $progress)
    {
        return Inertia::render('Progress/Show', [
            'client' => $client,
            'progress' => new ProgressResource($progress)
        ]);
    }

    /**
     * Show the form for editing the specified progress entry.
     */
    public function edit(Client $client, Progress $progress)
    {
        return Inertia::render('Progress/Edit', [
            'client' => $client,
            'progress' => new ProgressResource($progress)
        ]);
    }

    /**
     * Update the specified progress entry in storage.
     */
    public function update(UpdateProgressRequest $request, Client $client, Progress $progress)
    {
        $data = $request->validated();
        
        DB::transaction(function () use ($request, $progress, $data) {
            // Get existing images (ensure it's an array)
            $existingImages = $request->input('existing_images', []);
            $imagePaths = is_array($existingImages) ? $existingImages : [];
            
            // Handle new file uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    if ($image->isValid()) {
                        $path = $image->store('project-progress', 'public');
                        if ($path) {
                            $imagePaths[] = $path;
                        }
                    }
                }
            }
            
            // Store the image paths as a JSON array
            $data['images'] = $imagePaths;
            
            // Update the progress with the new data
            $progress->update($data);
        });

        return redirect()
            ->route('clients.progress.show', [$client, $progress])
            ->with('success', 'Progress updated successfully.');
    }

    /**
     * Remove the specified progress entry from storage.
     */
    public function destroy(Client $client, Progress $progress)
    {
        $progress->delete();

        return redirect()
            ->route('clients.progress.index', $client)
            ->with('success', 'Progress entry deleted successfully.');
    }
}
