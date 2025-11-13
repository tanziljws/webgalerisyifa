<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class ImageOptimizer
{
    /**
     * Create a thumbnail for an image
     *
     * @param string $imagePath
     * @param int $width
     * @param int $height
     * @param string $suffix
     * @return string|null
     */
    public static function createThumbnail($imagePath, $width = 300, $height = 300, $suffix = '_thumb')
    {
        try {
            // Get the file info
            $pathInfo = pathinfo($imagePath);
            $thumbnailName = $pathInfo['filename'] . $suffix . '.' . $pathInfo['extension'];
            $thumbnailPath = $pathInfo['dirname'] . '/' . $thumbnailName;
            
            // Check if thumbnail already exists
            if (Storage::disk('public')->exists($thumbnailPath)) {
                return $thumbnailPath;
            }
            
            // Create image manager with GD driver
            $manager = new ImageManager(new GdDriver());
            
            // Create thumbnail
            $image = $manager->read(Storage::disk('public')->path($imagePath));
            $image->cover($width, $height);
            
            // Save thumbnail
            $image->save(Storage::disk('public')->path($thumbnailPath));
            
            return $thumbnailPath;
        } catch (\Exception $e) {
            \Log::error('Thumbnail creation failed: ' . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Get optimized image URL with thumbnail
     *
     * @param string $imagePath
     * @param int $width
     * @param int $height
     * @return string
     */
    public static function getOptimizedImageUrl($imagePath, $width = 300, $height = 300)
    {
        // In a production environment, you would implement actual thumbnail generation
        // For now, we return the original image URL but you can implement thumbnail logic here
        
        // Check if a thumbnail exists
        $pathInfo = pathinfo($imagePath);
        $thumbnailName = $pathInfo['filename'] . '_thumb.' . $pathInfo['extension'];
        $thumbnailPath = $pathInfo['dirname'] . '/' . $thumbnailName;
        
        // If thumbnail exists, return its URL
        if (Storage::disk('public')->exists($thumbnailPath)) {
            return Storage::url($thumbnailPath);
        }
        
        // Otherwise return the original image URL
        return Storage::url($imagePath);
    }
    
    /**
     * Optimize image for web delivery
     *
     * @param string $imagePath
     * @param int $quality
     * @return bool
     */
    public static function optimizeImage($imagePath, $quality = 80)
    {
        try {
            // Create image manager with GD driver
            $manager = new ImageManager(new GdDriver());
            
            $image = $manager->read(Storage::disk('public')->path($imagePath));
            
            // Optimize based on image type
            $extension = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
            
            // Save optimized image
            switch ($extension) {
                case 'png':
                    $image->toPng();
                    break;
                case 'jpg':
                case 'jpeg':
                    $image->toJpeg($quality);
                    break;
                case 'webp':
                    $image->toWebp($quality);
                    break;
                default:
                    $image->toJpeg($quality);
            }
            
            // Save optimized image
            $image->save(Storage::disk('public')->path($imagePath));
            
            return true;
        } catch (\Exception $e) {
            \Log::error('Image optimization failed: ' . $e->getMessage());
            return false;
        }
    }
}