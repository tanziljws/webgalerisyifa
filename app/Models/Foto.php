<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageOptimizer;

class Foto extends Model
{
    use HasFactory;

    protected $table = 'foto';
    
    protected $fillable = [
        'judul',
        'deskripsi',
        'path',
        'file',
        'galery_id',
        'kategori_id',
        'status',
        'petugas_id',
        'likes_count'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relationships
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id');
    }

    public function galery()
    {
        return $this->belongsTo(Galery::class, 'galery_id');
    }

    /**
     * Get all comments for this foto
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'foto_id');
    }

    /**
     * Get approved comments only
     */
    public function approvedComments()
    {
        return $this->hasMany(Comment::class, 'foto_id')->where('status', 'approved');
    }

    /**
     * Get pending comments only
     */
    public function pendingComments()
    {
        return $this->hasMany(Comment::class, 'foto_id')->where('status', 'pending');
    }

    /**
     * Get rejected comments only
     */
    public function rejectedComments()
    {
        return $this->hasMany(Comment::class, 'foto_id')->where('status', 'rejected');
    }

    /**
     * Get all likes for this foto
     */
    public function likes()
    {
        return $this->hasMany(\App\Models\FotoLike::class, 'foto_id');
    }

    /**
     * Check if the foto is liked by a specific user, IP, or session
     */
    public function isLikedBy($userId = null, $ipAddress = null, $sessionId = null)
    {
        $query = $this->likes();
        
        if ($userId) {
            return $query->where('user_id', $userId)->exists();
        } elseif ($ipAddress) {
            return $query->where('ip_address', $ipAddress)->exists();
        } elseif ($sessionId) {
            return $query->where('session_id', $sessionId)->exists();
        }
        
        return false;
    }
    
    /**
     * Check if the authenticated user has liked this photo
     */
    public function isLikedByUser()
    {
        if (auth()->check()) {
            return $this->isLikedBy(auth()->id());
        }
        return false;
    }
    
    /**
     * Get the like count for this foto
     * Check if likes_count already loaded via withCount() to avoid additional queries
     */
    public function getLikesCountAttribute($value)
    {
        // If likes_count already exists in attributes (loaded via withCount), return it
        if (array_key_exists('likes_count', $this->attributes)) {
            return $this->attributes['likes_count'];
        }
        // Otherwise, count from relationship (fallback)
        return $this->likes()->count();
    }

    /**
     * Get download logs for this foto
     */
    public function downloadLogs()
    {
        return $this->hasMany(DownloadLog::class, 'foto_id');
    }


    // Scopes
    public function scopeAktif($query)
    {
        return $query->where('status', 'Aktif');
    }

    public function scopeNonaktif($query)
    {
        return $query->where('status', 'Nonaktif');
    }

    public function scopeByKategori($query, $kategoriId)
    {
        return $query->where('kategori_id', $kategoriId);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Accessors & Mutators
    public function getJudulAttribute($value)
    {
        return ucwords($value);
    }

    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = strtolower($value);
    }

    public function getFullPathAttribute()
    {
        $stored = $this->path ?: $this->file;
        return $stored ? asset('storage/' . $stored) : '';
    }

    public function getThumbnailPathAttribute()
    {
        // Return optimized thumbnail URL
        return $this->getOptimizedImageUrl(300, 300);
    }
    
    /**
     * Get optimized image URL
     */
    public function getOptimizedImageUrl($width = 300, $height = 300, $quality = 75)
    {
        return \App\Helpers\ImageOptimizer::getOptimizedImageUrl($this->path, $width, $height, $quality);
    }

    // Compatibility accessors/mutators to map `file` <-> `path`
    public function getFileAttribute($value)
    {
        // If `file` exists use it, otherwise fall back to `path`
        return $value ?: $this->attributes['path'] ?? null;
    }

    public function setFileAttribute($value)
    {
        // Keep both in sync without breaking existing code
        $this->attributes['file'] = $value;
        // Only set path if not already provided explicitly in same request
        if (!array_key_exists('path', $this->attributes) || empty($this->attributes['path'])) {
            $this->attributes['path'] = $value;
        }
    }

    // Methods
    public function isAktif()
    {
        return $this->status === 'Aktif';
    }

    public function getFileSize()
    {
        if ($this->path && Storage::exists('public/' . $this->path)) {
            return Storage::size('public/' . $this->path);
        }
        return 0;
    }

    public function getFileSizeFormatted()
    {
        $bytes = $this->getFileSize();
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getFileExtension()
    {
        return pathinfo($this->path, PATHINFO_EXTENSION);
    }

    public function isImage()
    {
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        return in_array(strtolower($this->getFileExtension()), $imageExtensions);
    }

    public function deleteFile()
    {
        if ($this->path && Storage::exists('public/' . $this->path)) {
            return Storage::delete('public/' . $this->path);
        }
        return false;
    }
}
