<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatalogItemTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'workmanship',
        'execution_technique',
        'm_title',
        'm_description',
        'collection'
    ];
}
