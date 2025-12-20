<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonumentType extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    public function monument()
    {
        return $this->hasMany(Monument::class, 'monument_type_id', 'id');
    }

}