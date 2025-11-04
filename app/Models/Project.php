<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'client_id',
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
        'progress',
        'images',
        'public_token',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => 'string',
        'progress' => 'integer',
        'images' => 'array',
    ];

    protected function casts(): array
    {
        return array_merge(parent::casts(), [
            'start_date' => 'date',
            'end_date' => 'date',
        ]);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // Handle file uploads for new records
            if (request()->hasFile('images')) {
                $uploadedImages = [];
                foreach (request()->file('images') as $image) {
                    if ($image->isValid()) {
                        $path = $image->store('project-progress', 'public');
                        if ($path) {
                            $uploadedImages[] = $path;
                        }
                    }
                }
                $model->images = $uploadedImages;
                return;
            }
            
            // Handle case where images are passed as an array of paths (from edit form)
            if (is_array($model->images)) {
                $model->images = array_filter($model->images, function($item) {
                    return is_string($item) && !empty(trim($item));
                });
                
                if (empty($model->images)) {
                    $model->images = null;
                } else {
                    // Clean up the paths
                    $model->images = array_map(function($path) {
                        // Remove any temporary paths or full URLs
                        if (str_contains($path, 'livewire-tmp/')) {
                            return null;
                        }
                        return ltrim(str_replace(['storage/app/public/', 'storage/'], '', $path), '/');
                    }, $model->images);
                    
                    // Remove any null values and reset array keys
                    $model->images = array_values(array_filter($model->images));
                }
                return;
            }

            // Handle JSON string input
            if (is_string($model->images)) {
                $decoded = json_decode($model->images, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $model->images = $decoded;
                    // Recursively handle the decoded value
                    static::boot();
                    $model->fireModelEvent('saving', false);
                    return;
                }
                // If not valid JSON, treat as single path
                $model->images = [$model->images];
                static::boot();
                $model->fireModelEvent('saving', false);
                return;
            }

            // Default to null if no valid images
            $model->images = null;
        });

        static::creating(function ($project) {
            if (empty($project->public_token)) {
                $project->public_token = Str::random(32);
            }
            
            // Set default progress to 0 if not set
            if (!isset($project->progress)) {
                $project->progress = 0;
            }
        });
    }

    protected $appends = ['public_link', 'image_urls'];
    
    /**
     * Get the image URLs for the project.
     *
     * @return array
     */
    public function getImageUrlsAttribute()
    {
        if (empty($this->images)) {
            return [];
        }
        
        // Handle both string and array formats
        $images = $this->images;
        
        if (is_string($images)) {
            $decoded = json_decode($images, true);
            $images = json_last_error() === JSON_ERROR_NONE ? $decoded : [$images];
        }
        
        if (!is_array($images)) {
            return [];
        }
        
        return array_filter(array_map(function($image) {
            if (!is_string($image)) {
                return null;
            }
            return asset('storage/' . ltrim($image, '/'));
        }, $images));
    }

    /**
     * Get the client that owns the project.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the progress updates for the project.
     */
    public function progressUpdates()
    {
        return $this->hasMany(Progress::class);
    }

    /**
     * Get the public URL for the project.
     */
    public function getPublicLinkAttribute()
    {
        return route('project.public', ['token' => $this->public_token]);
    }
}
