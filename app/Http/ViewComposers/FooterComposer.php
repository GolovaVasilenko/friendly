<?php


namespace App\Http\ViewComposers;

use App\Block;
use Illuminate\View\View;

class FooterComposer
{
    public function compose(View $view)
    {
        $blocks = [];
        $blocks = Block::query()
            ->where('style_class', 'footer-block')
            ->get();
        return $view->with('footer_blocks', $blocks);
    }
}
