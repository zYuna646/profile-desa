<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Umkm extends Model
{
    use HasFactory;

    protected $table = 'umkm';

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'owner',
        'description',
        'image',
        'price',
        'rating',
        'reviews',
        'phone',
        'address',
        'is_active'
    ];

    protected $appends = ['image_url'];

    protected $casts = [
        'price' => 'decimal:2',
        'rating' => 'decimal:1',
        'reviews' => 'integer',
        'is_active' => 'boolean'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(UmkmCategory::class, 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function images()
    {
        return $this->hasMany(UmkmImage::class)->orderBy('order');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return null;
    }
}