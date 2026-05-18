<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'name',
        'file_name',
        'mime_type',
        'path',
        'thumbnail_path',
        'disk',
        'size',
        'type',
        'alt',
        'caption',
        'uploaded_by',
    ];

    protected $appends = ['url', 'thumbnail_url', 'human_size'];

    public function getUrlAttribute(): string
    {
        return Storage::disk($this->disk)->url($this->path);
    }

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail_path) {
            return Storage::disk($this->disk)->url($this->thumbnail_path);
        }
        return $this->url;
    }

    public function getHumanSizeAttribute(): string
    {
        $bytes = $this->size;
        if ($bytes >= 1048576) return round($bytes / 1048576, 2) . ' MB';
        if ($bytes >= 1024) return round($bytes / 1024, 2) . ' KB';
        return $bytes . ' B';
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
