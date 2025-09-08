<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UmkmImage extends Model
{
    protected $fillable = ['umkm_id', 'image', 'caption', 'order'];

    protected $appends = ['image_url'];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }
}
