<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Search extends Model
{
    public static function searchInPages($str)
    {
        return DB::table('pages')
            ->join('page_translations', 'pages.id', '=', 'page_translations.page_id')
            ->where('page_translations.locale', app()->getLocale())
            ->where('page_translations.body', $str)
            ->orWhere('page_translations.title', $str)
            ->get();
    }

    public static function searchInWorks($str)
    {
         $data = DB::table('catalog_items')
            ->join('catalog_item_translations', 'catalog_items.id', '=', 'catalog_item_translations.catalog_item_id')
            ->where('catalog_item_translations.locale', app()->getLocale())
            ->where('catalog_item_translations.name', $str)
             ->distinct()
             ->get();

        foreach($data as &$item) {
            $model = CatalogItem::query()->where('id', $item->id)->first();
            if($model)
                $img = $model->getFirstMediaUrl('works');
            $item->image = $img;
         }
        return $data;
    }

    public static function searchInPosts($str)
    {
        return DB::table('posts')
            ->join('post_translations', 'posts.id', '=', 'post_translations.post_id')
            ->where('post_translations.locale', app()->getLocale())
            ->where('title', $str)
            ->orWhere('body', $str)
            ->get();
    }
}
