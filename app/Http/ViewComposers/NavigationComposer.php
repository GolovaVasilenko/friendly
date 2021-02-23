<?php

namespace App\Http\ViewComposers;

use App\Menu;
//use Illuminate\Support\Facades\View;
use App\MenuItem;
use Illuminate\View\View;

class NavigationComposer
{
    public function compose(View $view)
    {
        $menu = Menu::where('type', 'main-menu')->first();
        $items = MenuItem::query()
            ->where('menu_id', $menu->id)
            ->orderBy('position', 'asc')
            ->get();
        $menuItems = $menu->buildTree($items);
        return $view->with('mainMenu', $menuItems);
    }
}
