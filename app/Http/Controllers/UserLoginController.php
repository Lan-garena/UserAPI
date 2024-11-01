<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Services\UserService;

class UserLoginController extends Controller
{
    public function __construct(
        protected readonly UserService $userService
    ){
    }
    public function login(UserLoginRequest $request)
    {
        $data = $request->validated();


    }
}
