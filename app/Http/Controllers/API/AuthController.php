<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use JWTAuth;
use App\Repositories\Contracts\UserInterface;
use App\Repositories\Contracts\AuthInterface;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegistrationRequest;

class AuthController extends Controller
{
    protected $userInterface;
    protected $authInterface;

    /**
     * AuthController constructor.
     * @param UserInterface $userInterface
     * @param AuthInterface $authInterface
     */
    public function __construct(UserInterface $userInterface, AuthInterface $authInterface)
    {
        $this->userInterface = $userInterface;
        $this->authInterface = $authInterface;
    }

    /**
     * @param RegistrationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegistrationRequest $request)
    {
        try {
            $user = $this->authInterface->register($request);
            return $this->sendSuccess($user, "User created successfully", 201);
        } catch (Exception $exception) {
            return $this->sendFatalError();
        }

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            $loginCredentials = $this->authInterface->login($request);
            if (!$loginCredentials['token']) {
                return $this->sendError([], 'Invalid Email or Password', 401);
            }
            $user = $this->userInterface->findByEmail($loginCredentials['email']);
            return $this->sendSuccess(["user" => $user, 'token' => $loginCredentials['token']], 'Login Successful');
        } catch (Exception $exception) {
            return $this->sendFatalError();
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function logout(Request $request)
    {
        try {
            $this->authInterface->logout($request);
            return $this->sendSuccess([], 'User logged out successfully');
        } catch (Exception $exception) {
            return $this->sendFatalError();
        }
    }


}
