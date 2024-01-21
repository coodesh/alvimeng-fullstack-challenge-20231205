<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserAuthService;
use App\Http\Requests\RegisterUserRequest;

class UserAuthController extends Controller
{
    protected $userAuthService;

    public function __construct(UserAuthService $userAuthService)
    {
        $this->userAuthService = $userAuthService;
    }

    public function register(RegisterUserRequest $request)
    {
        $user = $this->userAuthService->createUser($request->validated());
        return response()->json(null, 201);

    }
}
