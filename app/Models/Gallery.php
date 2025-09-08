<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasActivity;

class Gallery extends Model
{
    use HasFactory, HasActivity;

    protected $fillable = [
        'title',
        'description',
        'category',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    public function images()
    {
        return $this->hasMany(GalleryImage::class)->orderBy('order');
    }

    public function getImageUrlAttribute()
    {
        $mainImage = $this->images()->where('order', 0)->first();
        if ($mainImage) {
            return $mainImage->image_url;
        }
        return 'https://placehold.co/800x600?text=Gallery+Image';
    }
}