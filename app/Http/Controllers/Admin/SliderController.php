<?php

namespace App\Http\Controllers\Admin;

use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $pageTitle = trans('admin.slider_list');
        return view('admin.sliders.index', compact('pageTitle'));
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function dataAjax()
    {
        $sliders = Slider::latest()->orderBy('id', 'desc')->get();

        return datatables()->of($sliders)
            ->addIndexColumn()
            ->addColumn('image', function($data) {
                return '<img src="' . $data->getFirstMediaUrl('sliders') . '" width=80 />';
            })
            ->addColumn('action', function($data) {
                $btn = '<a href="'. route('admin.sliders.edit', ['slider' => $data]) . '" class="edit btn btn-primary btn-sm">' . trans('admin.edit') . '</a>';
                $btn .= '&nbsp;&nbsp; <a href="#" class="removable-item btn btn-danger btn-sm">' . trans('admin.delete') . '</a>
                          <form class="removable-form" method="post" action="' . route('admin.sliders.destroy', ['slider' => $data]) . '">' . csrf_field() . ' ' . method_field("delete") . '</form>';
                return $btn;
            })
            ->rawColumns(['action', 'image'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $pageTitle = trans('admin.add_slider');
        return view('admin.sliders.add', compact('pageTitle'));
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
            'type' => 'required|string',
        ]);
        Slider::createSlider($request);
        return redirect()
            ->route('admin.sliders.index')
            ->with('success', trans('admin.page_created_successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return Response
     */
    public function edit(Slider $slider)
    {
        $pageTitle = trans('admin.edit_slider');
        return view('admin.sliders.edit', compact('slider', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Slider $slider
     * @return Response
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'type' => 'required|string',
        ]);
        $slider->updateSlider($request);
        return redirect()
            ->route('admin.sliders.edit', ['slider' => $slider])
            ->with('success', trans('admin.changes_saved_successfully'));
    }

    /**
     * @param Slider $slider
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Slider $slider)
    {
        $slider->deleteSlider();
        return redirect()
            ->route('admin.sliders.index')
            ->with('success', trans('admin.item_successfully_deleted'));
    }

    /**
     * @param Slider $slider
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function removeImage(Slider $slider)
    {
        if($slider->removeImage()) {
            return redirect()->route('admin.sliders.edit', ['slider' => $slider])
                ->with('success', trans('admin.item_successfully_deleted'));
        }
        return redirect()->route('admin.sliders.edit', ['slider' => $slider])
            ->with('errors', trans('admin.error_delete'));
    }
}
