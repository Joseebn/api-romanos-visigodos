<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArchitectureType extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    public function galleryImages()
    {
        return $this->hasMany(GalleryImage::class, 'type_id', 'id');
    }

    public function monument()
    {
        return $this->hasMany(Monument::class, 'architecture_type_id', 'id');
    }

    public function post()
    {
        return $this->hasMany(Monument::class, 'architecture_type_id', 'id');
    }
}
