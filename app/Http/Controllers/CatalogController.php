<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\CatalogItem;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * @param Request $request
     * @param string $cat
     * @param string $attr
     * @param string $value
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $cat = '', $attr = '', $value = '')
    {
        $headerTitle = trans('admin.catalog_title');
        $categories = Catalog::getOnlyParent();
        $catDirection = Catalog::getCatDirection();
        $catGenres = Catalog::getCatGenres();
        $ci = new CatalogItem();
        $itemAttributes = $ci->listAttributes();
        $criteria = [];
        $category = [];

        if(empty($value) && !empty($attr)) {
            $value = $attr;
            $attr = $cat;
            $cat = '';
        }

        if($cat) {
            $criteria['cat'] = $cat;
            $category = Catalog::where('slug', $cat)->first();
        }

        if($attr && $value) {
            $category = 1;
            $criteria['attr'] = $attr;
            $criteria['value'] = $value;
        }

        $catalogItems = $ci->getItems($criteria, 'catalog_items.position', 'ASC');

        return view('front.catalog.index', compact(
            'catalogItems',
            'headerTitle',
            'categories',
            'itemAttributes',
            'catGenres',
            'category',
            'catDirection'
        ));
    }

    public function single($slug)
    {
        $item = CatalogItem::where('slug', $slug)->first();
        $headerTitle = $item->name;
        $categories = Catalog::getOnlyParent();
        $catDirection = Catalog::getCatDirection();
        $catGenres = Catalog::getCatGenres();
        $ci = new CatalogItem();
        $itemAttributes = $ci->listAttributes();

        return view('front.catalog.single', compact(
            'item',
            'itemAttributes',
            'categories',
            'headerTitle',
            'catGenres',
            'catDirection'
        ));
    }

    public function ajaxValue(Request $request)
    {
        $results = [];
        $attr = $request->get('attribute');
        $items = CatalogItem::all();

        foreach($items as $i) {
            if(in_array($i->$attr, $results) or $i->$attr == null) continue;
            $results[] = $i->$attr;
        }
        return ['results' => $results];
    }
}
