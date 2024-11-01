<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        protected readonly UserService $userService
    ) {
    }
    public function register(UserRegisterRequest $request)
    {
        $data = $request->validated();
        $data['role_id'] = 1;

        $user = $this->userService->create($data);

        return UserResource::make($user);
    }
}
