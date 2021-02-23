<?php

namespace App;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Page extends Model implements TranslatableContract
{
    use Translatable;

    protected $fillable = ['slug', 'title', 'body', 'meta_title', 'meta_description'];
    public $translatedAttributes = ['title', 'body', 'meta_title', 'meta_description'];

    public function createPage(Request $request)
    {
        $this->slug = $request->input('slug');
        $this->title = $request->input('title');
        $this->body = $request->input('body');
        $this->meta_title = $request->input('meta_title');
        $this->meta_description = $request->input('meta_description');
        $this->save();
    }

    public function blocks()
    {
        return $this->hasMany(Block::class);
    }
}
