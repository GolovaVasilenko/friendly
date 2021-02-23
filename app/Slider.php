<?php

namespace App;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Slider extends Model implements HasMedia, TranslatableContract
{
    use HasMediaTrait;
    use Translatable;

    protected $fillable = ['title', 'subtitle', 'text_link', 'type', 'url'];
    public $translatedAttributes = ['title', 'subtitle', 'text_link'];

    /**
     * @param Request $request
     */
    public static function createSlider(Request $request)
    {
        $slider = self::create([
            'type'      => $request->get('type'),
            'title'     => $request->get('title'),
            'subtitle'  => $request->get('subtitle'),
            'url'       => $request->get('url'),
            'text_link' => $request->get('text_link'),
        ]);

        if($request->file('slider')) {
            $slider->addMedia($request->file('slider'))->toMediaCollection('sliders');
        }
    }

    /**
     * @param Request $request
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function updateSlider(Request $request)
    {
        $this->update([
            'type'      => $request->get('type'),
            'title'     => $request->get('title'),
            'subtitle'  => $request->get('subtitle'),
            'url'       => $request->get('url'),
            'text_link' => $request->get('text_link'),
        ]);
        if($request->file('slider')) {
            $this->addMedia($request->file('slider'))->toMediaCollection('sliders');
        }
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function removeImage()
    {
        $sliderMedia = $this->getFirstMedia('sliders');
        if(!empty($sliderMedia)) {
            return $sliderMedia->delete();
        } else {
            return false;
        }
    }

    /**
     * @throws \Exception
     */
    public function deleteSlider()
    {
        $this->removeImage();
        $this->delete();
    }
}
