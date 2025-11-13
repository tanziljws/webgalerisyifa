<?php

namespace App\Observers;

use App\Models\Foto;
use App\Helpers\ImageOptimizer;
use Illuminate\Support\Facades\Storage;

class FotoObserver
{
    /**
     * Handle the Foto "created" event.
     */
    public function created(Foto $foto): void
    {
        // Optimize the image when it's created
        if ($foto->path) {
            $this->optimizeImage($foto);
        }
    }

    /**
     * Handle the Foto "updated" event.
     */
    public function updated(Foto $foto): void
    {
        // Optimize the image when it's updated and the path changed
        if ($foto->isDirty('path') && $foto->path) {
            $this->optimizeImage($foto);
        }
    }

    /**
     * Optimize the image file
     */
    protected function optimizeImage(Foto $foto): void
    {
        try {
            // Only optimize if the file exists
            if (Storage::disk('public')->exists($foto->path)) {
                // Optimize the image for web delivery
                ImageOptimizer::optimizeImage($foto->path, 80);
                
                // Create a thumbnail for gallery listing
                ImageOptimizer::createThumbnail($foto->path, 300, 300, '_thumb');
            }
        } catch (\Exception $e) {
            \Log::error('Image optimization failed for foto ID ' . $foto->id . ': ' . $e->getMessage());
        }
    }
}