<?php

namespace App;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Nwidart\Menus\MenuBuilder;

class Menu extends Model implements TranslatableContract
{
    use Translatable;

    protected $fillable = ['title', 'type'];

    public $translatedAttributes = ['title'];

    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function scopeOfSort($query, $sort)
    {
        foreach ($sort as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        return $query;
    }

    public function makeMenu()
    {
        $menu = MenuItem::query()
            ->where('menu_id', $this->id)
            ->orderBy('position', 'asc')->get();

        return $this->buildTree($menu);
    }

    public function buildTree($items)
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
