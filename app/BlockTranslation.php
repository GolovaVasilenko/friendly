<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlockTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = ['title', 'subtitle', 'text_link', 'text'];
}
