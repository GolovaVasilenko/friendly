<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    protected $fillable = ['title', 'body', 'meta_title', 'meta_description'];

    public $timestamps = false;
}
