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
            // If images is null, set to null in the database
            if (is_null($model->images)) {
                $model->images = null;
                return;
            }

            // If images is already an array of strings, ensure they're properly formatted
            if (is_array($model->images)) {
                // Filter out any empty values
                $model->images = array_filter($model->images, function($item) {
                    return is_string($item) && !empty(trim($item));
                });
                
                // If no valid images, set to null
                if (empty($model->images)) {
                    $model->images = null;
                } else {
                    // Ensure all paths are relative to storage/app/public
                    $model->images = array_map(function($path) {
                        // Remove any leading slashes or storage/app/public/ prefix if present
                        return ltrim(str_replace(['storage/app/public/', 'storage/'], '', $path), '/');
                    }, $model->images);
                    
                    // Reset array keys
                    $model->images = array_values($model->images);
                }
                return;
            }

            // If images is a JSON string, decode it
            if (is_string($model->images)) {
                // Try to decode the JSON
                $decoded = json_decode($model->images, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $model->images = $decoded;
                    // Recursively handle the decoded value
                    static::boot();
                    $model->fireModelEvent('saving', false);
                    return;
                } else {
                    // If it's not valid JSON, treat it as a single path
                    $model->images = [$model->images];
                    // Recursively handle the array
                    static::boot();
                    $model->fireModelEvent('saving', false);
                    return;
                }
            }

            // If we get here, set to empty array
            $model->images = [];
            \Log::warning('Could not process images, set to empty array', ['input' => $model->images]);
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
