<?php

namespace App\Http\Controllers;

use App\Search;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search_query = strip_tags(trim($request->get('search'), ' '));
        $pageTitle = trans('admin.search');
        return view('front.pages.search_results', [
            'pageTitle' => $pageTitle,
            'results' => $this->results($search_query)
        ]);
    }

    /**
     * @param $str
     * @return array
     */
    public function results($str)
    {
        $response = [];
        /*$pages = Search::searchInPages($str)->toArray();
        $posts = Search::searchInPosts($str)->toArray();*/
        $works = Search::searchInWorks($str)->toArray();
        $response = array_merge($works/*, $pages, $posts*/);

        return $response;
    }
}
