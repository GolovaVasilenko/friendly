<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class MenuItem extends Model implements TranslatableContract
{
    use Translatable;

    protected $fillable = ['name', 'link', 'parent_id'];

    public $translatedAttributes = ['name'];
}
