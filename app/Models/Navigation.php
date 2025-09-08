<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    protected $fillable = [
        'name',
        'route',
        'url',
        'icon',
        'parent_id',
        'order',
        'is_active',
        'is_external',
        'news_id'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_external' => 'boolean',
    ];

    // Relasi parent-child
    public function parent()
    {
        return $this->belongsTo(Navigation::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Navigation::class, 'parent_id');
    }

    // Scope untuk mendapatkan navigasi utama (tanpa parent)
    public function scopeMainNavigation($query)
    {
        return $query->whereNull('parent_id')->where('is_active', true)->orderBy('order');
    }

    // Scope untuk mendapatkan navigasi aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    // Relasi dengan model News
    public function news()
    {
        return $this->belongsTo(News::class);
    }
    
    /**
     * Get the URL for this navigation item
     * 
     * @return string
     */
    public function getUrlAttribute()
    {
        try {
            if ($this->is_external && $this->url) {
                return $this->url;
            }
            
            if ($this->route === 'landing.news.show' && $this->news_id) {
                $news = $this->news;
                if ($news && $news->slug) {
                    return route($this->route, $news->slug);
                }
                // Jika berita tidak ditemukan atau tidak memiliki slug, arahkan ke halaman berita
                return route('landing.news.index');
            }
            
            if ($this->route) {
                try {
                    return route($this->route);
                } catch (\Exception $e) {
                    // Log error untuk debugging
                    \Log::warning('Invalid route "' . $this->route . '" for navigation "' . $this->name . '": ' . $e->getMessage());
                    // Fallback ke halaman utama
                    return '/';
                }
            }
            
            return '#';
        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::warning('Error generating URL for navigation "' . $this->name . '": ' . $e->getMessage());
            return '#';
        }
    }
    
    /**
     * Get the active status for form display
     * 
     * @return bool
     */
    public function getActiveAttribute()
    {
        return $this->is_active;
    }
}
