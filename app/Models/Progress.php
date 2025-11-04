<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Progress extends Model
{
    protected $fillable = [
        'project_id',
        'client_id',
        'title',
        'description',
        'status',
        'date',
        'images',
        'assigned_to',
        'completed_at',
    ];

    protected $casts = [
        'date' => 'date',
        'completed_at' => 'datetime',
        'images' => 'array', // Automatically cast to/from JSON
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_urls'];
    
    /**
     * Get the image URLs for the progress update.
     *
     * @return array
     */
    public function getImageUrlsAttribute()
    {
        if (empty($this->images)) {
            return [];
        }
        
        return array_map(function($image) {
            return asset('storage/' . ltrim($image, '/'));
        }, $this->images);
    }
    
    /**
     * Status constants
     */
    const STATUS_PENDING = 'pending';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    
    /**
     * Get the status options for the progress.
     *
     * @return array
     */
    public static function getStatusOptions()
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_COMPLETED => 'Completed',
        ];
    }

    /**
     * Get the project that owns the progress entry.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    
    /**
     * Get the client that owns the progress entry.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the user assigned to this progress.
     */
    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
