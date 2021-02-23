<?php

namespace App\Http\Controllers\Admin;

use App\Block;
use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = trans('admin.blocks_title');
        $blocks = Block::all();

        return view('admin.blocks.index', compact('pageTitle', 'blocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = trans('admin.block_add');
        $pages = Page::all();
        return view('admin.blocks.add', compact('pageTitle', 'pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Block::createBlock($request);
        return redirect()->route('admin.blocks.index')->with('success', trans('admin.page_created_successfully'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function edit(Block $block)
    {
        $pageTitle = trans('admin.block_edit');
        $pages = Page::all();
        return view('admin.blocks.edit', compact('block', 'pages', 'pageTitle'));
    }

    /**
     * @param Request $request
     * @param Block $block
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function update(Request $request, Block $block)
    {
        $block->updateBlock($request);
        return redirect()->route('admin.blocks.edit', ['block' => $block])
            ->with('success', trans('admin.changes_saved_successfully'));
    }

    /**
     * @param Block $block
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Block $block)
    {
        $block->deleteBlock();
        return redirect()->route('admin.blocks.index')
            ->with('success', trans('admin.item_successfully_deleted'));
    }

    public function removeImage(Block $block)
    {
        if($block->removeImage()) {
            return redirect()->route('admin.blocks.edit', ['block' => $block])
                ->with('success', trans('admin.item_successfully_deleted'));
        } else {
            return redirect()->route('admin.blocks.edit', ['block' => $block])
                ->with('errors', trans('admin.error_delete'));
        }

    }
}
