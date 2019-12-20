<?php
/**
 * Created by PhpStorm.
 * User: davidmogbeyiteren
 * Date: 2019-12-19
 * Time: 21:47
 */

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;


interface AuthInterface
{

    public function register(Request $request);

    public function login(Request $request);

}
