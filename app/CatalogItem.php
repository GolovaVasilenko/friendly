<?php

namespace App;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class CatalogItem extends Model implements HasMedia, TranslatableContract
{
    use HasMediaTrait;
    use Translatable;

    protected $fillable = [
        'name',
        'description',
        'execution_technique',
        'workmanship',
        'm_title',
        'm_description',
        'display_home',
        'slug',
        'size',
        'cdate',
        'collection',
        'position',
        'active',
    ];

    /**
     * @var array
     */
    public $translatedAttributes = [
        'name',
        'description',
        'execution_technique',
        'workmanship',
        'm_title',
        'm_description',
        'collection',
    ];

    public $image = "";

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Catalog::class, 'catalog_items_relations');
    }

    public static function checkSlug($slugStr, $id = 0)
    {
        if(self::query()->where('slug', $slugStr)
            ->where('id', '!=', $id)->first())
        {
            $slugStr .= '-' . Str::lower(Str::random(4));
        }
        return $slugStr;
    }

    /**
     * @param Request $request
     */
    public static function createItemCatalog(Request $request)
    {
        $slugStr = self::checkSlug($request->get('slug'));
        $item = self::create([
            'name' => $request->get('name'),
            'slug' => $slugStr,
            'cdate' => $request->get('cdate'),
            'size' => $request->get('size'),
            'collection' => $request->get('collection'),
            'description' => $request->get('description'),
            'workmanship' => $request->get('workmanship'),
            'execution_technique' => $request->get('execution_technique'),
            'm_title' => $request->get('m_title'),
            'm_description' => $request->get('m_description'),
        ]);
        if($request->get('display_home')) {
            $item->display_home = $request->get('display_home');
            $item->save();
        }
        $item->categories()->attach($request->get('categories'));
        if($request->hasFile('work_img')) {
            $item->addMedia($request->file('work_img'))->toMediaCollection('works');
        }
    }

    /**
     * @param Request $request
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function updateItemCatalog(Request $request)
    {
        $id = $request->get('id') ?? 0;
        $slugStr = self::checkSlug($request->get('slug'), $id);
        $this->update([
            'name' => $request->get('name'),
            'slug' => $slugStr,
            'cdate' => $request->get('cdate'),
            'size' => $request->get('size'),
            'collection' => $request->get('collection'),
            'description' => $request->get('description'),
            'workmanship' => $request->get('workmanship'),
            'execution_technique' => $request->get('execution_technique'),
            'm_title' => $request->get('m_title'),
            'm_description' => $request->get('m_description'),
        ]);

        $this->display_home = $request->get('display_home') ?? 0;
        $this->save();

        $this->categories()->sync($request->get('categories'));

        if($request->hasFile('work_img')) {
            $this->addMedia($request->file('work_img'))->toMediaCollection('works');
        }
    }

    /**
     * @throws \Exception
     */
    public function deleteItemCatalog()
    {
        $this->categories()->detach();
        $this->removeImage();
        $this->delete();
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function removeImage()
    {
        $itemMedia = $this->getFirstMedia('works');
        if(!empty($itemMedia)) {
            return $itemMedia->delete();
        } else {
            return false;
        }
    }

    /**
     * @return array
     */
    public function listAttributes()
    {
        return [
            'cdate' => trans('admin.cdate'),
            'workmanship' => trans('admin.material'),
            'execution_technique' => trans('admin.execution_technique'),
            'size' => trans('admin.size'),
            'collection' => trans('admin.collection'),
        ];
    }

    /**
     * @param array $criteria
     * @param string $orderBy
     * @param string $ordered
     * @param int $paginate
     * @return array|\Illuminate\Contracts\Pagination\LengthAwarePaginator|null
     */
    public function getItems($criteria = [], $orderBy = 'catalog_items.id', $ordered = 'DESC', $paginate = 12)
    {
        $result = null;
        if(empty($criteria)) {

            return $this->query()->where('active', 1)->orderBy($orderBy, $ordered)->paginate($paginate);
        } else {
            if(isset($criteria['cat'])) {
                if(isset($criteria['attr'])) {
                    $result = CatalogItem::select(
                        'catalog_items.id',
                        'catalog_items.slug',
                        'catalog_items.cdate',
                        'catalog_items.size',
                        'catalog_item_translations.name',
                        'catalog_item_translations.workmanship',
                        'catalog_item_translations.execution_technique',
                        'catalog_item_translations.collection'

                    )->join('catalog_items_relations', 'catalog_items.id', '=', 'catalog_items_relations.catalog_item_id')
                        ->join('catalogs', 'catalogs.id', '=', 'catalog_items_relations.catalog_id')
                        ->join('catalog_item_translations', 'catalog_item_translations.catalog_item_id', '=', 'catalog_items.id')
                        ->where('active', 1)
                        ->where( $criteria['attr'], $criteria['value'])
                        ->where('catalogs.slug', $criteria['cat'])
                        ->orderBy($orderBy, $ordered)->paginate($paginate);
                } else {
                    $cat = Catalog::where('slug', $criteria['cat'])->first();
                    if(!$cat) return [];
                    $result = $cat->items()->where('active', 1)->orderBy($orderBy, $ordered)->paginate($paginate);
                }
                return $result;
            }
            if (isset($criteria['attr']) && empty($criteria['cat'])) {

                $result = CatalogItem::select(
                    'catalog_items.id',
                    'catalog_items.slug',
                    'catalog_items.cdate',
                    'catalog_items.size',
                    'catalog_item_translations.name',
                    'catalog_item_translations.workmanship',
                    'catalog_item_translations.execution_technique',
                    'catalog_item_translations.collection'

                )->join('catalog_items_relations', 'catalog_items.id', '=', 'catalog_items_relations.catalog_item_id')
                    ->join('catalog_item_translations', 'catalog_item_translations.catalog_item_id', '=', 'catalog_items.id')
                    ->where($criteria['attr'], $criteria['value'])
                    ->where('active', 1)
                    //->orderBy($orderBy, $ordered)
                    ->distinct()
                    ->paginate($paginate);
                    return $result;
            }
        }
    }
}
