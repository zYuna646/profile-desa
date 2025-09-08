<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class InfographicType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($type) {
            if (!$type->slug) {
                $type->slug = Str::slug($type->name);
            }
        });
    }

    public function infographics()
    {
        return $this->hasMany(Infographic::class);
    }
}
