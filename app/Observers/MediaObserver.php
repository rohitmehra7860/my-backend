<?php

namespace App\Observers;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class MediaObserver
{
    public function forceDeleted(Media $media): void
    {
        Storage::disk($media->disk)->delete($media->path);

        if ($media->thumbnail_path) {
            Storage::disk($media->disk)->delete($media->thumbnail_path);
        }
    }
}
