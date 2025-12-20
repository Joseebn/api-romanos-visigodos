<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Monument extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'status',
        'monument_type_id',
        'architecture_type_id',
        'monument_path',
        'description',
        'image',
        'location',
    ];

    public function architectureType()
    {
        return $this->belongsTo(ArchitectureType::class, 'architecture_type_id', 'id');
    }

    public function monumentType()
    {
        return $this->belongsTo(MonumentType::class, 'monument_type_id', 'id');
    }

}
