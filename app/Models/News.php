<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Traits\HasActivity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasActivity;
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'is_active',
        'views',
        'category_id'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'views' => 'integer'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            if (! $news->slug) {
                $news->slug = Str::slug($news->title);
            }
        });

        static::updating(function ($news) {
            if ($news->isDirty('title') && ! $news->isDirty('slug')) {
                $news->slug = Str::slug($news->title);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(NewsCategory::class);
    }
}