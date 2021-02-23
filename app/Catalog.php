<?php

namespace App;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Catalog extends Model implements TranslatableContract
{
    use Translatable;

    public $img = '';

    protected $fillable = ['name', 'slug', 'm_title', 'm_description', 'description', 'parent_id', 'position'];

    public $translatedAttributes = ['name', 'description', 'm_title', 'm_description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items()
    {
        return $this->belongsToMany(CatalogItem::class, 'catalog_items_relations');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getCatDirection()
    {
        return self::query()->where('parent_id', 23)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getCatGenres()
    {
        return self::query()->where('parent_id', 24)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    public static function getOnlyParent()
    {
        $tempObj = null;
        $cat = self::query()
            ->where('parent_id', '0')
            ->whereNotIn('slug', ['mimartuleba', 'zhanri'])
            ->orderBy('position', 'ASC')
            ->get();
        foreach($cat as &$c) {
            foreach($c->items as $i) {
                if($i->display_home == 1) {
                    if($i) {
                        $c->img = $i->getFirstMediaUrl('works');
                    }
                }
            }
        }
        return $cat;
    }

    /**
     * @param Request $request
     */
    public static function addCatalog(Request $request)
    {
        self::create([
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'parent_id' => $request->get('parent_id'),
            'description' => $request->get('description'),
            'm_title' => $request->get('m_title'),
            'm_description' => $request->get('m_description')
        ]);

    }

    /**
     * @param Request $request
     */
    public function updateCatalog(Request $request)
    {
        $this->update([
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'parent_id' => $request->get('parent_id'),
            'description' => $request->get('description'),
            'm_title' => $request->get('m_title'),
            'm_description' => $request->get('m_description')
        ]);
    }

    /**
     * @return mixed
     */
    public static function buildTree()
    {
        $catalog = self::query()->get();
        return self::makeTree($catalog);
    }

    /**
     * @param $items
     * @return mixed
     */
    public static function makeTree($items)
    {
        $grouped = $items->groupBy('parent_id');

        foreach ($items as $item) {
            if ($grouped->has($item->id)) {
                $item->children = $grouped[$item->id];
            }
        }

        return $items->where('parent_id', 0);
    }
}
