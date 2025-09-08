<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceTemplate extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'name',
        'file_path',
        'description',
        'is_active',
        'variables'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'variables' => 'array'
    ];

    /**
     * Get the services that use this template.
     */
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
