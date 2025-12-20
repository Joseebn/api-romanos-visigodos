<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'status',
        'architecture_type_id',
        'synopsis',
        'post_path',
        'image',
        'body',
        'seo_keyword',
        'seo_description',
        'publication_data',
    ];

    public function architectureType()
    {
        return $this->belongsTo(ArchitectureType::class, 'architecture_type_id', 'id');
    }
}
