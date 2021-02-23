<?php

namespace App\Http\Controllers\Admin;

use App\Catalog;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $catalogList = Catalog::buildTree();

        $pageTitle = trans('admin.catalog_list');
        return view('admin.catalog.index', compact('catalogList', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $pageTitle = trans('admin.catalog_add');
        $categories = Catalog::all();
        return view('admin.catalog.add', compact('categories', 'pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|unique:catalogs',
        ]);

        Catalog::addCatalog($request);
        return redirect()->route('admin.catalog.index')
            ->with('success', trans('admin.page_created_successfully'));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function changePosition(Request $request)
    {
        $id = (int) $request->get('id');
        $position = (int) $request->get('position');
        $model = Catalog::find($id);
        $model->position = $position;
        $model->save();
        return ['ok'];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Catalog $catalog
     * @return Response
     */
    public function edit(Catalog $catalog)
    {
        $pageTitle = trans('admin.catalog_edit');
        $categories = Catalog::all();
        return view('admin.catalog.edit', compact('pageTitle', 'categories', 'catalog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Catalog $catalog
     * @return Response
     */
    public function update(Request $request, Catalog $catalog)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required',
        ]);

        $catalog->updateCatalog($request);
        return redirect()->route('admin.catalog.edit', ['catalog' => $catalog])
            ->with('success', trans('admin.changes_saved_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Catalog $catalog
     * @return Response
     * @throws Exception
     */
    public function destroy(Catalog $catalog)
    {
        $catalog->delete();
        return redirect()->route('admin.catalog.index')
            ->with('success', trans('admin.item_successfully_deleted'));
    }
}
