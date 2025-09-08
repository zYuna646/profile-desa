<?php

namespace App\Traits;

use App\Models\Activity;

trait HasActivity
{
    public static function bootHasActivity()
    {
        static::created(function ($model) {
            $model->recordActivity('created');
        });

        static::updated(function ($model) {
            $model->recordActivity('updated');
        });

        static::deleted(function ($model) {
            $model->recordActivity('deleted');
        });
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'reference');
    }

    protected function recordActivity(string $type)
    {
        $description = match ($type) {
            'created' => sprintf('%s baru telah ditambahkan', class_basename($this)),
            'updated' => sprintf('%s telah diperbarui', class_basename($this)),
            'deleted' => sprintf('%s telah dihapus', class_basename($this)),
            default => $type,
        };

        $this->activities()->create([
            'description' => $description,
            'type' => $type,
            'user_id' => auth()->id(),
        ]);
    }
}