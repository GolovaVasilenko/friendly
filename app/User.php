<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class User extends Authenticatable
{
    use Notifiable;

    const ROLE_USER = 1;
    const ROLE_REDACTOR = 31;
    const ROLE_ADMIN = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role == self::ROLE_ADMIN;
    }

    public function isRedactor()
    {
        return $this->role == self::ROLE_REDACTOR;
    }

    /**
     * @return HasOne
     */
    public function userMeta()
    {
        return $this->hasOne(UserMeta::class);
    }

    /**
     * @param Request $request
     */
    public static function addUser(Request $request)
    {
        $user = self::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => (int) $request->input('role'),
        ]);
        if($user) {
            $metaData = $request->input('meta');

            $userMeta = $user->userMeta()->create([
                'country' => $metaData['country'],
                'city' => $metaData['city'],
                'birthday' => $metaData['birthday'],
            ]);

            if($request->file('avatar')) {
                $userMeta->addAvatar($request->file('avatar'));
            }
        }
    }

    /**
     * @param Request $request
     */
    public function updateUser(Request $request)
    {
        $this->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => (int) $request->input('role')
        ]);

        $metaData = $request->input('meta');

        $userMetaId = $this->userMeta()->update([
            'country' => $metaData['country'],
            'city' => $metaData['city'],
            'birthday' => $metaData['birthday'],
        ]);

        if($request->hasFile('avatar')) {
            $this->userMeta->addAvatar($request->file('avatar'));
        }
    }

    /**
     *
     */
    public function deleteUserMeta()
    {
        $this->userMeta->removeAvatar();
        return $this->userMeta()->delete();
    }

    /**
     * @return mixed
     */
    public function getAvatarUrl()
    {
        return $this->userMeta->getAvatar();
    }

}
