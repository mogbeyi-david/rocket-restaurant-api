<?php
/**
 * Created by PhpStorm.
 * User: davidmogbeyiteren
 * Date: 2019-12-19
 * Time: 21:48
 */

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\AuthInterface;
use Illuminate\Http\Request;
use JWTAuth;


class AuthRepository implements AuthInterface
{

    public function register($request)
    {
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone_number = $request->phoneNumber;
        $user->password = Hash::make($request->password);
        $user->save();
        return $user;
    }

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($input)) {
            return false;
        }
        return [
            'token' => $token,
            'email' => $input['email']
        ];
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function logout(Request $request)
    {
        return JWTAuth::invalidate(JWTAuth::getToken());
    }
}
