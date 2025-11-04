<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client_id' => 'required|exists:clients,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'nullable|in:pending,in_progress,completed',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePaths = [];
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

        $project = Project::create(array_merge($validated, [
            'public_token' => Str::random(32),
            'images' => $imagePaths,
            'progress' => 0,
        ]));

        return response()->json($project, 201);
    }

    /**
     * Display the specified project.
     */
    public function show(Project $project)
    {
        return response()->json($project);
    }

    /**
     * Update the specified project in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update($validated);
        return response()->json($project);
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(null, 204);
    }

    /**
     * Display project progress for clients
     */
    /**
     * Display public project progress view
     */
    public function publicView($token)
    {
        try {
            // First, find the project by token with client and progress relationships
            $project = Project::with([
                'client',
                'progressUpdates' => function($query) {
                    $query->orderBy('date', 'desc');
                }
            ])->where('public_token', $token)->firstOrFail();

            // Get the progress updates and ensure it's a collection
            $progress = $project->progressUpdates ?: collect();
            
            // Calculate progress percentage safely
            $totalTasks = $progress->count();
            $completedTasks = $progress->where('status', 'completed')->count();
            $progressPercentage = $totalTasks > 0 ? (int) round(($completedTasks / $totalTasks) * 100) : 0;

            // Add the progress percentage to the project object
            $project->progress_percentage = $progressPercentage;

            return view('public.project-progress', [
                'project' => $project,
                'progress' => $progress,
                'progressPercentage' => $progressPercentage
            ]);

        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error in publicView: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            
            // Return a 404 page if project not found or any other error occurs
            abort(404, 'Project not found or not publicly accessible.');
        }
    }

    /**
     * Display project progress for clients (admin view)
     */
    public function clientView(Project $project)
    {
        // Eager load the progress with client and order by date
        $project->load(['progress' => function($query) {
            $query->latest('date');
        }]);

        return view('client.progress', [
            'project' => $project,
            'progress' => $project->progress,
            'client' => $project->client
        ]);
    }
}
