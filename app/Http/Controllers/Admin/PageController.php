<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.page.index', ['pageTitle' => trans('admin.page_list')]);
    }

    public function pagesAjaxData()
    {
        return datatables()->of(Page::latest()->get())
            ->addIndexColumn()
            ->addColumn('action', function($data) {
                $btn = '<a href="' . route('pages.edit', ['page' => $data]) . '" class="edit btn btn-primary btn-sm">' . trans('admin.edit') . '</a>';
                $btn .= '&nbsp;&nbsp; <a href="#" class="removable-item btn btn-danger btn-sm">' . trans('admin.delete') . '</a>
                          <form class="removable-form" method="post" action="' . route('pages.destroy', ['id' => $data->id]) . '">' . csrf_field() . ' ' . method_field("delete") . '</form>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.page.add-edit', [
            'pageTitle' => trans('admin.page_creation'),
            'route' => 'pages.store',
            'params' => [],
            'method' => null
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $page = new Page();

        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|unique:pages',
        ]);
        $page->createPage($request);

        return redirect()->route('pages.index')->with('success', trans('admin.page_created_successfully'));
    }

    /**
     * @param Page $page
     * @return Factory|View
     */
    public function edit(Page $page)
    {
        return view('admin.page.add-edit', [
            'page' => $page,
            'pageTitle' => trans('admin.page_editing'),
            'route' => 'pages.update',
            'params' => [$page],
            'method' => 'PUT'
        ]);
    }

    /**
     * @param Request $request
     * @param Page $page
     * @return RedirectResponse
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string',
            'slug' => 'required',
        ]);

        $page->title = $request->input('title');
        $page->slug = $request->input('slug');
        $page->body = $request->input('body');
        $page->meta_title = $request->input('meta_title');
        $page->meta_description = $request->input('meta_description');

        $page->save();
        return redirect()->route('pages.edit', ['page' => $page])->with('success', trans('admin.changes_saved_successfully'));
    }

    /**
     * @param Page $page
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('pages.index')->with('success', trans('admin.item_successfully_deleted'));
    }
}
