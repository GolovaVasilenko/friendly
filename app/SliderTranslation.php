<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SliderTranslation extends Model
{
    protected $fillable = ['title', 'subtitle', 'text_link'];

    public $timestamps = false;
}
