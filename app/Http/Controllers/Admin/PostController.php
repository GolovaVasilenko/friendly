<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Rubric;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.posts.index', [
            'pageTitle' => trans('admin.post_list')
        ]);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function dataAjax()
    {
        $posts = Post::latest()->with('rubrics')->get();

        return datatables()->of($posts)
            ->addIndexColumn()
            ->addColumn('image', function($data) {
                return '<img src="' . $data->getFirstMediaUrl('images') . '" width=80 />';
            })
            ->addColumn('action', function($data) {
                $btn = '<a href="'. route('admin.posts.edit', ['post' => $data]) . '" class="edit btn btn-primary btn-sm">' . trans('admin.edit') . '</a>';
                $btn .= '&nbsp;&nbsp; <a href="#" class="removable-item btn btn-danger btn-sm">' . trans('admin.delete') . '</a>
                          <form class="removable-form" method="post" action="' . route('admin.posts.destroy', ['id' => $data->id]) . '">' . csrf_field() . ' ' . method_field("delete") . '</form>';
                return $btn;
            })
            ->addColumn('rubric', function($data) {
                $results = '';
                foreach($data->rubrics as $rubric) {
                    $results .= $rubric->title . ', <br>';
                }
                return $results;
            })
            ->rawColumns(['action', 'image', 'rubric'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Rubric $rubrics
     * @return Factory|View
     */
    public function create(Rubric $rubrics)
    {
        return view('admin.posts.create', [
            'pageTitle' => trans('admin.new_post'),
            'rubrics'   => $rubrics->query()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|unique:posts',
        ]);
        Post::createPost($request);
        return redirect()->route('admin.posts.index')->with('success', trans('admin.page_created_successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Rubric $rubrics
     * @param Post $post
     * @return Factory|View
     */
    public function edit(Rubric $rubrics, Post $post)
    {
        return view('admin.posts.edit', [
            'pageTitle' => trans('admin.edit_post'),
            'post' => $post,
            'rubrics' => $rubrics->query()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string',
            'slug' => 'required',
        ]);

        $post->updatePost($request);
        return redirect()->route('admin.posts.edit', ['post' => $post])->with('success', trans('admin.changes_saved_successfully'));
    }

    /**
     * @param Post $post
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post->deletePost();
        return redirect()->route('admin.posts.index')->with('success', trans('admin.item_successfully_deleted'));
    }

    /**
     * @param Post $post
     * @return RedirectResponse
     * @throws \Exception
     */
    public function removePostImage(Post $post)
    {
        if($post->removeImage()) {
            return redirect()->route('admin.posts.edit', ['post' => $post])->with('success', trans('admin.item_successfully_deleted'));
        } else {
            return redirect()->route('admin.posts.edit', ['post' => $post])->with('errors', trans('admin.error_delete'));
        }

    }
}
