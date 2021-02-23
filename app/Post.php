<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Post extends Model implements HasMedia, TranslatableContract
{
    use HasMediaTrait;
    use Translatable;

    protected $fillable = ['title', 'slug', 'intro', 'body', 'meta_title', 'meta_description'];

    public $translatedAttributes = ['title', 'intro', 'body', 'meta_title', 'meta_description'];

    /**
     * @return BelongsToMany
     */
    public function rubrics()
    {
        return $this->belongsToMany(Rubric::class, 'post_rubrics');
    }

    /**
     * @param Request $request
     */
    public static function createPost(Request $request)
    {
        $post = self::create([
            'title' => $request->input('title'),
            'slug'  => $request->input('slug'),
            'intro' => $request->input('intro'),
            'body'  => $request->input('body'),
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
        ]);

        $post->rubrics()->attach($request->get('rubrics'));

        if($request->file('image')) {
            $post->addMedia($request->file('image'))->toMediaCollection('images');
        }
    }

    public function updatePost(Request $request)
    {
        $this->title = $request->input('title');
        $this->slug = $request->input('slug');
        $this->intro = $request->input('intro');
        $this->body = $request->input('body');
        $this->meta_title = $request->input('meta_title');
        $this->meta_description = $request->input('meta_description');
        $this->save();

        $this->rubrics()->sync($request->get('rubrics'));

        if($request->hasFile('image')) {
            $this->addMedia($request->file('image'))->toMediaCollection('images');
        }
    }

    /**
     * @throws \Exception
     */
    public function deletePost()
    {
        $this->rubrics()->detach();
        $this->removeImage();
        $this->delete();
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function removeImage()
    {
        $postMedia = $this->getFirstMedia('images');
        if(!empty($postMedia)) {
            return $postMedia->delete();
        } else {
            return false;
        }
    }
}
