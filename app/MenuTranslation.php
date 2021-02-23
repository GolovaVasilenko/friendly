<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuTranslation extends Model
{
    protected $fillable = ['title'];
    public $timestamps = false;
}
