<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'icon',
        'image',
        'order',
        'is_active',
        'service_template_id',
        'template_data'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'template_data' => 'array'
    ];
    
    /**
     * Get the template associated with this service.
     */
    public function template()
    {
        return $this->belongsTo(ServiceTemplate::class, 'service_template_id');
    }
}
