<?php

namespace App;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media as BaseMedia;

class Media extends BaseMedia implements HasMedia, TranslatableContract
{
    use HasMediaTrait;
    use Translatable;

    public $timestamps = false;
    protected $fillable = ['title', 'alt', 'description'];

    public $translatedAttributes = ['title', 'alt', 'description'];

    public static $limitList = [20, 60, 100, 160];
    public static $currentLimit = 20;

    /**
     * @param array $criteria
     * @param array $orderBy
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public static function getAll($criteria = [], $orderBy = ['id', 'DESC'], $limit = 20) {
        $response = Media::query();
        if(!empty($criteria))
            $response->where($criteria[0], $criteria[1]);
        if(!empty($orderBy))
            $response->orderBy($orderBy[0], $orderBy[1]);
        return $response->paginate($limit);
    }

    /**
     * @return Collection
     */
    public static function getCollectionList()
    {
        $collection = Media::query()->pluck('collection_name');
        return $collection->unique();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public static function updateMedia(Request $request)
    {
        $media = self::find($request->get('id'));
        $media->title = $request->get('title');
        $media->alt = $request->get('alt');
        $media->description = $request->get('description');
        $media->save();
        return  $media;
    }
}
