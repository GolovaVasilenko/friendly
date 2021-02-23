<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Rubric extends Model implements TranslatableContract, HasMedia
{
    use Translatable;
    use HasMediaTrait;

    protected $fillable = ['title', 'slug', 'parent_id', 'description', 'meta_title', 'meta_description'];
    public $translatedAttributes = ['title', 'description', 'meta_title', 'meta_description'];

    /**
     * @return BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_rubrics');
    }

    /**
     * @param Request $request
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function createRubric(Request $request)
    {
        $this->create([
            'title' => $request->input('title'),
            'slug'  => $request->input('slug'),
            'parent_id' => $request->input('parent_id'),
            'description'  => $request->input('description'),
            'meta_title' => $request->input('meta_title'),
            'meta_description'  => $request->input('meta_description'),
        ]);
        if($request->hasFile('catImage')) {
            $this->addMedia($request->file('catImage'))->toMediaCollection('catImages');
        }
    }

    /**
     * @param Request $request
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function updateRubric(Request $request)
    {
        $this->title = $request->input('title');
        $this->slug = $request->input('slug');
        $this->parent_id = $request->input('parent_id');
        $this->description = $request->input('description');
        $this->meta_title = $request->input('meta_title');
        $this->meta_description = $request->input('meta_description');

        $this->save();

        if($request->hasFile('catImage')) {
            $this->addMedia($request->file('catImage'))->toMediaCollection('catImages');
        }
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function removeImage()
    {
        $mediaItem = $this->getFirstMedia('catImages');
        if($mediaItem) $mediaItem->delete();
        return true;
    }

    public function getImage()
    {
        return $this->getFirstMedia('catImages');
    }
}
