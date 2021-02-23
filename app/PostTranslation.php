<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = ['title', 'intro', 'body', 'meta_title', 'meta_description'];
}
