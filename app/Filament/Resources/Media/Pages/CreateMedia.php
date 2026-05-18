<?php

namespace App\Filament\Resources\Media\Pages;

use App\Filament\Resources\Media\MediaResource;
use App\Models\Media;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;

class CreateMedia extends CreateRecord
{
    protected static string $resource = MediaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $paths = is_array($data['path']) ? $data['path'] : [$data['path']];

        // Create first record normally
        $firstPath = array_shift($paths);
        $data = $this->buildMediaData($firstPath, $data);

        // Create remaining records
        foreach ($paths as $path) {
            Media::create($this->buildMediaData($path, $data));
        }

        return $data;
    }

    private function buildMediaData(string $path, array $data): array
    {
        $fullPath = Storage::disk('public')->path($path);
        $mime     = mime_content_type($fullPath) ?? 'application/octet-stream';
        $type     = $this->getType($mime);

        return [
            'name'           => $data['name'] ?? pathinfo($path, PATHINFO_FILENAME),
            'file_name'      => basename($path),
            'mime_type'      => $mime,
            'path'           => $path,
            'thumbnail_path' => $type === 'image' ? $this->generateThumbnail($fullPath, $path, $mime) : null,
            'disk'           => 'public',
            'size'           => Storage::disk('public')->size($path),
            'type'           => $type,
            'alt'            => $data['alt'] ?? null,
            'caption'        => $data['caption'] ?? null,
            'uploaded_by'    => auth()->id(),
        ];
    }

    private function getType(string $mime): string
    {
        if (str_starts_with($mime, 'image/')) return 'image';
        if (str_starts_with($mime, 'video/')) return 'video';
        return 'document';
    }

    private function generateThumbnail(string $fullPath, string $path, string $mime): ?string
    {
        try {
            if ($mime === 'image/jpeg') $src = imagecreatefromjpeg($fullPath);
            elseif ($mime === 'image/png') $src = imagecreatefrompng($fullPath);
            elseif ($mime === 'image/gif') $src = imagecreatefromgif($fullPath);
            elseif ($mime === 'image/webp') $src = imagecreatefromwebp($fullPath);
            else return null;

            $srcW  = imagesx($src);
            $srcH  = imagesy($src);
            $ratio = min(300 / $srcW, 300 / $srcH);
            $newW  = (int)($srcW * $ratio);
            $newH  = (int)($srcH * $ratio);
            $thumb = imagecreatetruecolor($newW, $newH);

            if (in_array($mime, ['image/png', 'image/gif'])) {
                imagealphablending($thumb, false);
                imagesavealpha($thumb, true);
            }

            imagecopyresampled($thumb, $src, 0, 0, 0, 0, $newW, $newH, $srcW, $srcH);

            $folder        = dirname($path);
            $thumbFileName = 'thumb_' . basename($path);
            $thumbPath     = $folder . '/' . $thumbFileName;
            $fullThumbPath = Storage::disk('public')->path($thumbPath);

            if ($mime === 'image/jpeg') imagejpeg($thumb, $fullThumbPath, 85);
            elseif ($mime === 'image/png') imagepng($thumb, $fullThumbPath);
            elseif ($mime === 'image/gif') imagegif($thumb, $fullThumbPath);
            elseif ($mime === 'image/webp') imagewebp($thumb, $fullThumbPath, 85);

            imagedestroy($src);
            imagedestroy($thumb);

            return $thumbPath;
        } catch (\Exception $e) {
            return null;
        }
    }
}
