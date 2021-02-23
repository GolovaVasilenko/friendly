<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.users.index', ['pageTitle' => trans('admin.user_list')]);
    }

    public function dataAjax(User $user)
    {
        return datatables()->of($user->query()->get())
            ->addIndexColumn()
            ->addColumn('avatar', function($data) {
                return '<img src="' . $data->userMeta->getFirstMediaUrl('avatars') . '" width=50 />';
            })
            ->addColumn('action', function($data) {
                $btn = '<a href="' . route('users.show', ['user' => $data]) . '" class="edit btn btn-success btn-sm">' . trans('admin.show') . '</a>';
                $btn .= ' &nbsp;&nbsp;<a href="' . route('users.edit', ['user' => $data]) . '" class="edit btn btn-primary btn-sm">' . trans('admin.edit') . '</a>';
                $btn .= '&nbsp;&nbsp; <a href="#" class="removable-item btn btn-danger btn-sm">' . trans('admin.delete') . '</a>
                          <form class="removable-form" method="post" action="' . route('users.destroy', ['user' => $data]) . '">' . csrf_field() . ' ' . method_field("delete") . '</form>';
                return $btn;
            })
            ->rawColumns(['action', 'avatar'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.users.add', ['pageTitle' => trans('admin.add_user')]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);
        User::addUser($request);

        return redirect()->route('users.index')
            ->with('success', trans('admin.page_created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Factory|View
     */
    public function show(User $user)
    {
        return view('admin.users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Factory|View
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'pageTitle' => trans('admin.edit_user'),
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required'
        ]);

        $user->updateUser($request);
        return redirect()->route('users.edit', [$user])
            ->with('success', trans('admin.changes_saved_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->deleteUserMeta();
        $user->delete();
        return redirect()->route('users.index')
            ->with('success', trans('admin.item_successfully_deleted'));
    }
}
