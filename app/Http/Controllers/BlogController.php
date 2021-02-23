<?php

namespace App\Http\Controllers;

use App\Rubric;
use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function index($rubricSlug)
    {
        $posts = [];
        $rubric = Rubric::where('slug', $rubricSlug)->first();
        if($rubric)
            $headerTitle = $rubric->title;
            $posts = $rubric->posts()->orderBy('id', 'DESC')->paginate(6);
        return view('front.blog.index', compact('headerTitle', 'posts'));
    }

    public function single($slug)
    {
        $post = Post::query()->where('slug', $slug)->first();

        return view('front.blog.single', compact('post'));
    }


}
