<?php

namespace App\Http\Controllers\Admin;

use App\Rubric;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;

class RubricController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.rubrics.index', [
            'pageTitle' => trans('admin.rubric_list'),
            'rubrics' => Rubric::all()
        ]);
    }

    public function dataAjax()
    {
        return datatables()->of(Rubric::latest()->get())
            ->addIndexColumn()
            ->addColumn('action', function($data) {
                $btn = '<a href="' . route('admin.rubrics.edit', ['rubric' => $data]) . '" class="edit btn btn-primary btn-sm">' . trans('admin.edit') . '</a>';
                $btn .= '&nbsp;&nbsp; <a href="#" class="removable-item btn btn-danger btn-sm">' . trans('admin.delete') . '</a>
                          <form class="removable-form" method="post" action="' . route('admin.rubrics.delete', ['rubric' => $data]) . '">' . csrf_field() . ' ' . method_field("delete") . '</form>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(Request $request)
    {
        $rubric = new Rubric();

        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|unique:rubrics',
        ]);

        $rubric->createRubric($request);

        return redirect()->route('admin.rubrics.index')->with('success', trans('admin.page_created_successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Rubric $rubric
     * @return Factory|View
     */
    public function edit(Rubric $rubric)
    {
        return view('admin.rubrics.edit', [
            'pageTitle' => trans('admin.rubric_edit'),
            'rubric' => $rubric,
            'rubrics' => Rubric::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Rubric $rubric
     * @return RedirectResponse
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(Request $request, Rubric $rubric)
    {
        $request->validate([
            'title' => 'required|string',
            'slug' => 'required'
        ]);

        $rubric->updateRubric($request);

        return redirect()->route('admin.rubrics.edit', ['rubric' => $rubric])->with('success', trans('admin.changes_saved_successfully'));
    }

    /**
     * @param Rubric $rubric
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Rubric $rubric)
    {
        $rubric->removeImage();
        $rubric->delete();
        return redirect()->route('admin.rubrics.index')->with('success', trans('admin.item_successfully_deleted'));
    }

    /**
     * @param Rubric $rubric
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroyImage(Rubric $rubric)
    {
        $rubric->removeImage();
        return redirect()->back()->with('success', trans('admin.item_successfully_deleted'));
    }
}
