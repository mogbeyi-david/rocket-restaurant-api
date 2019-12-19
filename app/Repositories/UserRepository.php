<?php
/**
 * Created by PhpStorm.
 * User: davidmogbeyiteren
 * Date: 2019-12-19
 * Time: 21:46
 */

namespace App\Repositories;

use App\Repositories\Contracts\UserInterface;
use App\User;


class UserRepository implements UserInterface
{

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}
