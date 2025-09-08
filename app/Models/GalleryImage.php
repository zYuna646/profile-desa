<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasActivity;

class GalleryImage extends Model
{
    use HasFactory, HasActivity;

    protected $fillable = [
        'gallery_id',
        'image',
        'caption',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return 'https://placehold.co/800x600?text=Gallery+Image';
    }
}