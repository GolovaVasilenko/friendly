<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RubricTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'description', 'meta_title', 'meta_description'];
}
