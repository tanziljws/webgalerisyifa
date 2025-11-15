<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Illuminate\Support\Facades\Cache;

class ImageOptimizer
{
    /**
     * Generate optimized image on-the-fly and return response
     * This method resizes and compresses images for better performance
     *
     * @param string $imagePath Path to image in storage
     * @param int $width Target width (0 = auto)
     * @param int $height Target height (0 = auto)
     * @param int $quality Compression quality (1-100, lower = smaller file)
     * @return \Illuminate\Http\Response|null
     */
    public static function serveOptimizedImage($imagePath, $width = 0, $height = 0, $quality = 75)
    {
        try {
            // Resolve actual file path
            $fullPath = self::resolveImagePath($imagePath);
            
            if (!$fullPath || !file_exists($fullPath)) {
                return null;
            }

            // Create cache key for this specific optimization
            $cacheKey = 'img_' . md5($imagePath . $width . $height . $quality . filemtime($fullPath));
            
            // Check if optimized version exists in cache directory
            $cacheDir = storage_path('app/cache/images');
            if (!is_dir($cacheDir)) {
                mkdir($cacheDir, 0755, true);
            }
            
            $cachedPath = $cacheDir . '/' . $cacheKey . '.' . pathinfo($fullPath, PATHINFO_EXTENSION);
            
            // Serve cached version if exists
            if (file_exists($cachedPath)) {
                return response()->file($cachedPath, [
                    'Content-Type' => mime_content_type($cachedPath),
                    'Cache-Control' => 'public, max-age=31536000', // 1 year cache
                ]);
            }

            // Create image manager
            $manager = new ImageManager(new GdDriver());
            $image = $manager->read($fullPath);
            
            // Get original dimensions
            $originalWidth = $image->width();
            $originalHeight = $image->height();
            
            // Calculate target dimensions (maintain aspect ratio)
            if ($width > 0 && $height > 0) {
                // Specific dimensions - use cover (crop to fit)
                $image->cover($width, $height);
            } elseif ($width > 0) {
                // Width only - maintain aspect ratio
                $image->scale(width: $width);
            } elseif ($height > 0) {
                // Height only - maintain aspect ratio
                $image->scale(height: $height);
            } else {
                // No resize, just compress
                // For mobile, limit max dimensions to 1200px
                if ($originalWidth > 1200 || $originalHeight > 1200) {
                    // Calculate scale to fit within 1200px while maintaining aspect ratio
                    $scale = min(1200 / $originalWidth, 1200 / $originalHeight);
                    $newWidth = (int)($originalWidth * $scale);
                    $newHeight = (int)($originalHeight * $scale);
                    $image->scale(width: $newWidth, height: $newHeight);
                }
            }
            
            // Get file extension
            $extension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
            
            // Save optimized image to cache
            switch ($extension) {
                case 'png':
                    $image->toPng()->save($cachedPath);
                    break;
                case 'jpg':
                case 'jpeg':
                    $image->toJpeg($quality)->save($cachedPath);
                    break;
                case 'webp':
                    $image->toWebp($quality)->save($cachedPath);
                    break;
                case 'gif':
                    // GIFs are not optimized, just copy
                    copy($fullPath, $cachedPath);
                    break;
                default:
                    $image->toJpeg($quality)->save($cachedPath);
            }
            
            // Return optimized image
            return response()->file($cachedPath, [
                'Content-Type' => mime_content_type($cachedPath),
                'Cache-Control' => 'public, max-age=31536000',
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Image optimization failed: ' . $e->getMessage());
            // Fallback to original image
            $fullPath = self::resolveImagePath($imagePath);
            if ($fullPath && file_exists($fullPath)) {
                return response()->file($fullPath);
            }
            return null;
        }
    }

    /**
     * Resolve image path from various possible locations
     *
     * @param string $imagePath
     * @return string|null
     */
    private static function resolveImagePath($imagePath)
    {
        // Remove leading slash if present
        $imagePath = ltrim($imagePath, '/');
        
        // Try different possible locations
        $candidates = [
            Storage::path('public/' . $imagePath),
            public_path('storage/' . $imagePath),
            public_path($imagePath),
            storage_path('app/public/' . $imagePath),
        ];
        
        foreach ($candidates as $candidate) {
            if (file_exists($candidate)) {
                return $candidate;
            }
        }
        
        return null;
    }
    
    /**
     * Get optimized image URL (for use in views)
     * Returns a route URL that will serve the optimized image
     *
     * @param string $imagePath
     * @param int $width
     * @param int $height
     * @param int $quality
     * @return string
     */
    public static function getOptimizedImageUrl($imagePath, $width = 300, $height = 300, $quality = 75)
    {
        // Remove storage path prefix if present
        $imagePath = str_replace('storage/', '', $imagePath);
        $imagePath = ltrim($imagePath, '/');
        
        // Return route URL for optimized image
        return route('image.optimized', [
            'path' => base64_encode($imagePath),
            'w' => $width,
            'h' => $height,
            'q' => $quality
        ]);
    }
    
    /**
     * Create a thumbnail for an image (legacy method, kept for compatibility)
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
            
            $fullPath = self::resolveImagePath($imagePath);
            if (!$fullPath || !file_exists($fullPath)) {
                return null;
            }
            
            // Create thumbnail
            $image = $manager->read($fullPath);
            $image->cover($width, $height);
            
            // Save thumbnail with compression
            $thumbnailFullPath = Storage::disk('public')->path($thumbnailPath);
            $extension = strtolower($pathInfo['extension']);
            
            if ($extension === 'png') {
                $image->toPng()->save($thumbnailFullPath);
            } else {
                $image->toJpeg(75)->save($thumbnailFullPath);
            }
            
            return $thumbnailPath;
        } catch (\Exception $e) {
            \Log::error('Thumbnail creation failed: ' . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Optimize image for web delivery (legacy method)
     *
     * @param string $imagePath
     * @param int $quality
     * @return bool
     */
    public static function optimizeImage($imagePath, $quality = 80)
    {
        try {
            $fullPath = self::resolveImagePath($imagePath);
            if (!$fullPath || !file_exists($fullPath)) {
                return false;
            }
            
            // Create image manager with GD driver
            $manager = new ImageManager(new GdDriver());
            $image = $manager->read($fullPath);
            
            // Optimize based on image type
            $extension = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
            
            // Save optimized image
            switch ($extension) {
                case 'png':
                    $image->toPng()->save($fullPath);
                    break;
                case 'jpg':
                case 'jpeg':
                    $image->toJpeg($quality)->save($fullPath);
                    break;
                case 'webp':
                    $image->toWebp($quality)->save($fullPath);
                    break;
                default:
                    $image->toJpeg($quality)->save($fullPath);
            }
            
            return true;
        } catch (\Exception $e) {
            \Log::error('Image optimization failed: ' . $e->getMessage());
            return false;
        }
    }
}