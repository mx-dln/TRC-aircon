<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProjectController;


// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Public routes that don't require authentication
Route::middleware(['web'])
    ->withoutMiddleware(['auth'])
    ->group(function () {
        // Public project progress view
        Route::get('/project/{token}', [ProjectController::class, 'publicView'])
            ->name('project.public');
    });

// Debug route - remove this in production
Route::get('/debug/project/{id}', function($id) {
    try {
        $project = \App\Models\Project::with('progress')->findOrFail($id);
        
        // Safely get progress data
        $progress = $project->progress ?: collect();
        
        // Dump project and progress for debugging
        dd([
            'project' => $project->toArray(),
            'progress' => $progress->toArray(),
            'progress_count' => $progress->count(),
            'project_attributes' => $project->getAttributes(),
            'relations' => $project->getRelations(),
        ]);
        
    } catch (\Exception $e) {
        dd([
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
    }
})->name('debug.project');

// Auth routes
require __DIR__ . '/auth.php';

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Client Project Progress
    Route::prefix('client/project')->name('client.project.')->group(function () {
        Route::get('/{project:slug}', [ProjectController::class, 'clientView'])->name('show');
    });
    // Public project view (legacy URL support)
    Route::get('/project/{token}', [ProjectController::class, 'publicView'])->name('project.public');
});
