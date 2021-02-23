<?php


namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AdminMainComposer
{
    protected $user;

    /**
     * AdminMainComposer constructor.
     */
    public function __construct()
    {
        $this->user = Auth::user();
        $this->user->avatar = $this->user->getAvatarUrl();
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('user', $this->user);
    }
}
