<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DictionaryTerm extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'term_path'];

}
