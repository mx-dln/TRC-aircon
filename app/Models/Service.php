<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'description',
        'icon',
        'color',
        'video_type',
        'video_url',
        'video_file',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at');
    }

    /**
     * Get the video URL for embedding or display
     */
    public function getVideoEmbedUrl()
    {
        if ($this->video_type === 'youtube') {
            return $this->extractYoutubeEmbedUrl($this->video_url);
        } elseif ($this->video_type === 'vimeo') {
            return $this->extractVimeoEmbedUrl($this->video_url);
        } elseif ($this->video_type === 'file') {
            return asset("storage/{$this->video_file}");
        }
        return null;
    }

    /**
     * Extract YouTube embed URL from watch URL
     */
    private function extractYoutubeEmbedUrl($url)
    {
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return "https://www.youtube.com/embed/{$matches[1]}";
        }
        return $url;
    }

    /**
     * Extract Vimeo embed URL from watch URL
     */
    private function extractVimeoEmbedUrl($url)
    {
        if (preg_match('/vimeo\.com\/(\d+)/', $url, $matches)) {
            return "https://player.vimeo.com/video/{$matches[1]}";
        }
        return $url;
    }
}
