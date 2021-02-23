<?php

namespace App\Http\Controllers\Admin;

use App\Media;
use App\MediaItem;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $media = Media::getAll([], ['id' , 'DESC'], Media::$currentLimit);
        $mediaCollections = Media::getCollectionList();

        $pageTitle = trans('admin.media_list_title');
        return view('admin.media.index', compact('pageTitle', 'media', 'mediaCollections'));
    }

    public function ajaxDataMedia()
    {
        $results = [];
        $media = Media::getAll([], ['id' , 'DESC'], 400);
        foreach($media as $item) {
            $results[$item->id] = $item->getUrl();
        }
        return $results;
    }

    /**
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    public function filter(Request $request)
    {
        $criteria = [];
        $pageTitle = trans('admin.media_list_title');
        $limit = $request->get('limit');
        $collectionName = $request->get('collection_name');

        if($collectionName) {
            $criteria = ['collection_name' , $collectionName];
        }
        Media::$currentLimit = $limit;
        $mediaCollections = Media::getCollectionList();
        $media = Media::getAll($criteria, ['id' , 'desc'], $limit);

        return view('admin.media.index', compact(
            'mediaCollections',
            'pageTitle',
            'media'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(Request $request)
    {
        $media = new MediaItem();
        $typeModel = $request->get('typeModel');

        if($request->hasFile('media')) {
            foreach($request->file('media') as $file) {
                $media->addMedia($file)->toMediaCollection($typeModel);
                $media->save();
            }
            return redirect()->back()->with('success', trans('admin.success_select_files'));
        }
        return redirect()->back()->with('errors', trans('admin.error_select_files'));
    }

    /**
     * Display the specified resource.
     *
     * @param Media $media
     * @return Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * @param Media $media
     * @return Factory|View
     */
    public function edit(Media $media)
    {
        $pageTitle = trans('admin.media_edit');
        return view('admin.media.edit', compact('media', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $mediaModel = Media::updateMedia($request);
        return redirect()->route('admin.media.edit', [$mediaModel])->with('success', trans('admin.changes_saved_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     * @param Media $media
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Media $media)
    {
        $media->delete();
        return redirect()->route('admin.media.index')
            ->with('success', trans('admin.item_successfully_deleted'));
    }
}
