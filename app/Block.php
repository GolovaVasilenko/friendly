<?php

namespace App;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Block extends Model implements HasMedia, TranslatableContract
{
    use HasMediaTrait;
    use Translatable;

    protected $fillable = ['title', 'subtitle', 'text_link', 'text', 'link', 'style_id', 'style_class', 'page_id'];

    public $translatedAttributes = ['title', 'subtitle', 'text_link', 'text'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * @param Request $request
     */
    public static function createBlock(Request $request)
    {
        $page = Page::where('id', $request->get('page_id'))->first();
        $block = self::create([
            'title' => $request->get('title'),
            'subtitle' => $request->get('subtitle'),
            'text_link' => $request->get('text_link'),
            'text' => $request->get('text'),
            'link' => $request->get('link'),
            'style_id' => $request->get('style_id'),
            'style_class' => $request->get('style_class'),
            'page_id' => $request->get('page_id')
        ]);

        $page->blocks()->save($block);

        if($request->file('block_img')) {
            $block->addMedia($request->file('block_img'))->toMediaCollection('blocks');
        }
    }

    /**
     * @param Request $request
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function updateBlock(Request $request)
    {
        $page = Page::where('id', $request->get('page_id'))->first();
        $this->update([
            'title' => $request->get('title'),
            'subtitle' => $request->get('subtitle'),
            'text_link' => $request->get('text_link'),
            'text' => $request->get('text'),
            'link' => $request->get('link'),
            'style_id' => $request->get('style_id'),
            'style_class' => $request->get('style_class'),
            'page_id' => $request->get('page_id')
        ]);

        $page->blocks()->save($this);

        if($request->file('block_img')) {
            $this->addMedia($request->file('block_img'))->toMediaCollection('blocks');
        }
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function removeImage()
    {
        $media = $this->getFirstMedia('blocks');
        if(!empty($media)) {
            return $media->delete();
        } else {
            return false;
        }
    }

    /**
     * @throws \Exception
     */
    public function deleteBlock()
    {
        $this->page()->dissociate();
        $this->removeImage();
        $this->delete();
    }
}
