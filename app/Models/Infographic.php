<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Infographic extends Model
{
    use HasFactory;

    protected $fillable = [
        'infographic_type_id',
        'title',
        'slug',
        'description',
        'image',
        'data',
        'diagram_type',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'data' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($infographic) {
            if (!$infographic->slug) {
                $infographic->slug = Str::slug($infographic->title);
            }
        });
    }

    public function type()
    {
        return $this->belongsTo(InfographicType::class, 'infographic_type_id');
    }
}
