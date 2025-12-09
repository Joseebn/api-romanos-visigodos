<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GalleryImage extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'image_path', 'image_id', 'type_id'];

    public function architectureType()
    {
        return $this->belongsTo(ArchitectureType::class, 'type_id', 'id');
    }

}
