<?php

namespace App\Http\Controllers\Admin;

use App\Catalog;
use App\CatalogItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CatalogItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $pageTitle = trans('admin.work_list');
        return view('admin.catalog.items', compact('pageTitle'));
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function dataAjax()
    {
        return datatables()->of(CatalogItem::query()->orderBy('position', 'ASC')->get())
            ->addIndexColumn()
            ->addColumn('image', function($data) {
                return '<img src="' . $data->getFirstMediaUrl('works') . '" width=80 />';
            })
            ->addColumn('active', function($data) {
                if($data->active) {
                    $status = 'checked="checked" value="0"';
                } else {
                    $status = 'value="1"';
                }
                return '<div class="form-group">
                      <div class="wrapp-checkbox">
                        <input type="checkbox" name="active" class="toggleActive" data-id="' . $data->id . '" ' .  $status . '/>
                      </div>
                    </div>';
            })
            ->addColumn('position', function($data) {
                return '<input type="number" class="edit-position-js" value="' . $data->position . '" data-id="' . $data->id . '" style="width:60px;text-align:center;" /> 
                <button class="btn btn-primary btn-sm position-save-btn-js" style="display:none;margin:-4px 0 0 4px;font-size:10px;">' . trans("admin.save") . '</button>';
            })
            ->addColumn('action', function($data) {
                $btn = '<a href="' . route('admin.catalog.items.edit', ['item' => $data]) . '" class="edit btn btn-primary btn-sm">' . trans('admin.edit') . '</a>';
                $btn .= '&nbsp;&nbsp; <a href="#" class="removable-item btn btn-danger btn-sm">' . trans('admin.delete') . '</a>
                          <form class="removable-form" method="post" action="' . route('admin.catalog.items.destroy', ['item' => $data]) . '">' . csrf_field() . ' ' . method_field("delete") . '</form>';
                return $btn;
            })
            ->rawColumns(['action', 'image', 'position', 'active'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $pageTitle = trans('admin.create_new_catalog_item');
        $catalogList = Catalog::getOnlyParent();
        $catDirection = Catalog::getCatDirection();
        $catGenres = Catalog::getCatGenres();
        return view('admin.catalog.add_item', compact(
            'pageTitle',
            'catalogList',
            'catDirection',
            'catGenres'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
        ]);
        CatalogItem::createItemCatalog($request);
        return redirect()->route('admin.catalog.items.index')
            ->with('success', trans('admin.page_created_successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CatalogItem  $catalogItem
     * @return Response
     */
    public function edit(CatalogItem $catalogItem)
    {
        $pageTitle = trans('admin.update_new_catalog_item');
        $catalogList = Catalog::getOnlyParent();
        $catDirection = Catalog::getCatDirection();
        $catGenres = Catalog::getCatGenres();
        return view('admin.catalog.edit_item', compact(
            'pageTitle',
            'catalogList',
            'catalogItem',
            'catDirection',
            'catGenres'
        ));
    }

    /**
     * @param Request $request
     * @param CatalogItem $catalogItem
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function update(Request $request, CatalogItem $catalogItem)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required',
        ]);
        $catalogItem->updateItemCatalog($request);
        return redirect()->route('admin.catalog.items.edit', ['catalogItem' => $catalogItem])
            ->with('success', trans('admin.changes_saved_successfully'));
    }

    /**
     * @param CatalogItem $item
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function removeImage(CatalogItem $item)
    {
        if($item->removeImage()) {
            return redirect()->route('admin.catalog.items.edit', ['item' => $item])
                ->with('success', trans('admin.item_successfully_deleted'));
        }
        return redirect()->route('admin.catalog.items.edit', ['item' => $item])
            ->with('errors', trans('admin.error_delete'));
    }

    /**
     * @param CatalogItem $catalogItem
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(CatalogItem $catalogItem)
    {
        $catalogItem->deleteItemCatalog();
        return redirect()->route('admin.catalog.items.index')
            ->with('success', trans('admin.item_successfully_deleted'));
    }

    public function changePosition(Request $request)
    {
        $id = (int) $request->get('id');
        $position = (int) $request->get('position');
        $model = CatalogItem::find($id);
        $model->position = $position;
        $model->save();
        return ['ok'];
    }

    public function triggerActive(Request $request)
    {
        $id = (int) $request->get('id');
        $value = (int) $request->get('value');
        $model = CatalogItem::find($id);
        $model->active = $value;
        $model->save();
        return ["ok"];
    }
}
