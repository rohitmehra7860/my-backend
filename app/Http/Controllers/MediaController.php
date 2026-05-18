<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::with('uploader')
            ->latest()
            ->paginate(20);

        return response()->json($media);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file'    => 'required|file|max:102400',
            'alt'     => 'nullable|string|max:255',
            'caption' => 'nullable|string',
        ]);

        $file        = $request->file('file');
        $mime        = $file->getMimeType();
        $type        = $this->getType($mime);
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension   = $file->getClientOriginalExtension();
        $fileName    = Str::slug($originalName) . '-' . uniqid() . '.' . $extension;
        $folder      = 'media/' . date('Y/m');

        // Store original file
        $path = $file->storeAs($folder, $fileName, 'public');

        // Generate thumbnail for images
        $thumbPath = null;
        if ($type === 'image') {
            $thumbPath = $this->generateThumbnail(
                Storage::disk('public')->path($path),
                $folder,
                $fileName,
                $mime
            );
        }

        $media = Media::create([
            'name'           => $originalName,
            'file_name'      => $fileName,
            'mime_type'      => $mime,
            'path'           => $path,
            'thumbnail_path' => $thumbPath,
            'disk'           => 'public',
            'size'           => $file->getSize(),
            'type'           => $type,
            'alt'            => $request->alt,
            'caption'        => $request->caption,
            'uploaded_by'    => auth()->id(),
        ]);

        return response()->json([
            'message' => 'Uploaded successfully',
            'media'   => [
                'id'            => $media->id,
                'name'          => $media->name,
                'url'           => $media->url,
                'thumbnail_url' => $media->thumbnail_url,
                'size'          => $media->human_size,
                'type'          => $media->type,
                'mime_type'     => $media->mime_type,
            ],
        ], 201);
    }

    public function show($id)
    {
        $media = Media::with('uploader')->findOrFail($id);

        return response()->json([
            'id'            => $media->id,
            'name'          => $media->name,
            'url'           => $media->url,
            'thumbnail_url' => $media->thumbnail_url,
            'size'          => $media->human_size,
            'type'          => $media->type,
            'mime_type'     => $media->mime_type,
            'alt'           => $media->alt,
            'caption'       => $media->caption,
            'uploaded_by'   => $media->uploader->name,
            'created_at'    => $media->created_at,
        ]);
    }

    public function update(Request $request, $id)
    {
        $media = Media::findOrFail($id);

        $request->validate([
            'name'    => 'nullable|string|max:255',
            'alt'     => 'nullable|string|max:255',
            'caption' => 'nullable|string',
        ]);

        $media->update($request->only('name', 'alt', 'caption'));

        return response()->json([
            'message' => 'Updated successfully',
            'media'   => $media,
        ]);
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);

        Storage::disk('public')->delete($media->path);
        if ($media->thumbnail_path) {
            Storage::disk('public')->delete($media->thumbnail_path);
        }

        $media->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }

    private function getType(string $mime): string
    {
        if (str_starts_with($mime, 'image/')) return 'image';
        if (str_starts_with($mime, 'video/')) return 'video';
        return 'document';
    }

    private function generateThumbnail(string $sourcePath, string $folder, string $fileName, string $mime): ?string
    {
        try {
            if ($mime === 'image/jpeg') $src = imagecreatefromjpeg($sourcePath);
            elseif ($mime === 'image/png') $src = imagecreatefrompng($sourcePath);
            elseif ($mime === 'image/gif') $src = imagecreatefromgif($sourcePath);
            elseif ($mime === 'image/webp') $src = imagecreatefromwebp($sourcePath);
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

            $thumbFileName = 'thumb_' . $fileName;
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
