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
            return response()->json([
                'success' => true,
                'data' => $user
            ], 201);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => $exception->getMessage(),
                'message' => "Something went wrong, we are already looking into it"
            ], 500);
        }

    }

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }

        // Get the user details
        $user = $this->userInterface->findByEmail($input['email']);

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }


}
