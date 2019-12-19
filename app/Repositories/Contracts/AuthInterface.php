<?php
/**
 * Created by PhpStorm.
 * User: davidmogbeyiteren
 * Date: 2019-12-19
 * Time: 21:47
 */

namespace App\Repositories\Contracts;


interface AuthInterface
{

    public function register();

    public function login();

}
