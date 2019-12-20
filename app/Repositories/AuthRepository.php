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

    public function login()
    {
        // TODO: Implement login() method.
    }
}
