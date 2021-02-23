<?php

namespace App\Http\Controllers\Admin;

use App\Media;
use App\MediaItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $criteria = ['collection_name' , 'noName'];
        $media = Media::getAll($criteria, ['id' , 'desc'], 12);
        $pageTitle = trans('admin.photo_album');
        return view('admin.photos.index', compact('pageTitle', 'media'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function store(Request $request)
    {
        $media = new MediaItem();
        if($request->hasFile('media')) {
            foreach($request->file('media') as $file) {
                $media->addMedia($file)->toMediaCollection('noName');
                $media->save();
            }
            return redirect()->back()->with('success', trans('admin.success_select_files'));
        }
        return redirect()->back()->with('errors', trans('admin.error_select_files'));
    }

    /**
     * @param Media $media
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Media $media, $id)
    {
        $media = Media::where('id', $id)->first();
        $pageTitle = trans('admin.media_edit');
        return view('admin.photos.edit', compact('media', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $media)
    {
        $mediaModel = Media::updateMedia($request);
        return redirect()->route('admin.albums.edit', [$mediaModel])
            ->with('success', trans('admin.changes_saved_successfully'));
    }

    /**
     * @param Media $album
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Media $album)
    {
        $album->delete();
        return redirect()->route('admin.albums.index')
            ->with('success', trans('admin.item_successfully_deleted'));
    }
}
