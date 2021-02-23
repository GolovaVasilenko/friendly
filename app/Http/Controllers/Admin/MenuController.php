<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use App\MenuItem;
use Illuminate\View\View;

class MenuController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $pageTitle = trans('admin.menu');
        $menus = Menu::all();
        return view('admin.menu.index', compact('menus', 'pageTitle'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeMenu(Request $request)
    {
        //TODO : validation
        $menu = new Menu();
        $menu->title = $request->get('title');
        $menu->type = $request->get('type');
        $menu->save();
        return redirect()->route('admin.menu.index')
            ->with('success', trans('admin.page_created_successfully'));
    }

    public function editMenu($id)
    {
        $pageTitle = trans('admin.menu');

        $menu = Menu::find($id);
        return view('admin.menu.editMenu', compact('pageTitle', 'menu'));
    }

    public function updateMenu(Request $request)
    {
        $menu = Menu::find($request->get('id'));

        $menu->title = $request->get('title');
        $menu->save();
        return redirect()->route('admin.menu.index')
            ->with('success', trans('admin.changes_saved_successfully'));
    }

    /**
     * @param Menu $menu
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroyMenu(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menu.index')
            ->with('success', trans('admin.item_successfully_deleted'));
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function items($menu_id)
    {
        $pageTitle = trans('admin.menu');
        $menus = Menu::all();
        $menu = Menu::find($menu_id);
        $menuItems = $menu->makeMenu();

        return view('admin.menu.items', compact('menu', 'menuItems',  'pageTitle', 'menus'));
    }

    /**
     * @param Request $request
     * @param Menu $menu
     * @return RedirectResponse
     */
    public function itemStore(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string',
            'link' => 'required|string',
        ]);
        $pageTitle = trans('admin.menu');
        $menus = Menu::all();
        $item = $menu->items()->create([
            'parent_id' => $request->get('parent_id') ?? 0,
            'name' => $request->get('name'),
            'link' => $request->get('link'),
            'icon' => $request->get('icon'),
        ]);
        $item->position = MenuItem::query()->max('position') + 1;
        $item->save();
        return redirect()->route('admin.menu.items', ['menu_id' => $menu->id])
            ->with('success', trans('admin.page_created_successfully'));
    }

    public function updatePosition(Request $request)
    {
        $output = json_decode($request->get('output'));
        $this->setPosition($output);
        echo json_encode(['response' => 'ok']); exit();
    }

    /**
     * @param $output
     * @param int $parent
     */
    private function setPosition($output, $parent = 0)
    {
        $count = 1;
        foreach($output as $item) {
            if(isset($item->children)) {
                $this->setPosition($item->children, $item->id);
            }
            $model = MenuItem::find($item->id);
            $model->position = $count;
            $model->parent_id = $parent;

            $count++;
            $model->save();
        }
    }

    /**
     * @param $menu_id
     * @param $id
     * @return Factory|View
     */
    public function editItem($menu_id, $id)
    {
        $pageTitle = trans('admin.edit');
        $itemEdit = MenuItem::find($id);
        return view('admin.menu.edit', [
            'itemEdit' => $itemEdit,
            'menu_id' => $menu_id,
            'pageTitle' => $pageTitle
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateItem(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'link' => 'required|string',
        ]);
        $itemEdit = MenuItem::find($request->get('id'));
        $menu_id = $request->get('menu_id');
        $itemEdit->name = $request->get('name');
        $itemEdit->link = $request->get('link');
        $itemEdit->icon = $request->get('icon');
        $itemEdit->save();
        return redirect()->route('admin.menu.items', ['menu_id' => $menu_id])
            ->with('success', trans('admin.changes_saved_successfully'));
    }

    /**
     * @param $menu_id
     * @param $id
     * @return RedirectResponse
     */
    public function destroyItem($menu_id, $id)
    {
        $item = MenuItem::find($id);
        $item->delete();
        return redirect()->route('admin.menu.items', ['menu_id' => $menu_id])
            ->with('success', trans('admin.item_successfully_deleted'));
    }
}
