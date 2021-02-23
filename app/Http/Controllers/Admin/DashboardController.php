<?php

namespace App\Http\Controllers\Admin;

use App\CatalogItem;
use App\Post;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class DashboardController extends Controller
{

    public function index()
    {
        $postCount = Post::all()->count();
        $workCount = CatalogItem::all()->count();
        $usersCount = User::all()->count();
        return view('admin.dashboard.index', [
            'postCount' => $postCount,
            'workCount' => $workCount,
            'usersCount' => $usersCount,
        ]);
    }

    public function login()
    {
        return view('admin.dashboard.login');
    }

    /**
     * @return RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('main');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $email = $request->get('email');
        $password = $request->get('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            Auth::login(Auth::user(), true);
            return redirect()->intended('/cabinet');
        } else {
            return redirect()->back()->with('login-failed', trans('auth.failed'));
        }
    }
}
