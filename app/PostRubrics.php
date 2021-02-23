<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostRubrics extends Model
{
    protected $fillable = ['post_id', 'rubric_id'];
}
