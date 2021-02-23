<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItemTranslation extends Model
{
    protected $fillable = ['name', 'link', 'icon'];
    public $timestamps = false;
}
