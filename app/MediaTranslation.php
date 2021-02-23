<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaTranslation extends Model
{
    public $timestamps = false;

    public $translatedAttributes = ['title', 'alt', 'description'];
}
