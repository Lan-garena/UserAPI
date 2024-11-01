<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Support\Facades\Config;

enum roleId: int
{
    case user = 1;
}
class AuthController extends Controller
{
    public function __construct(
        protected readonly UserService $userService,
    ) {
    }

    public function register(UserRegisterRequest $request): UserResource
    {
        $data = $request->validated();

        $data['role_id'] = roleId::user->value;
        $user = $this->userService->create($data);

        return UserResource::make($user);
    }

    public function login(UserLoginRequest $request)
    {
        $credentials = $request->validated();

        if (! $token = auth()->attempt($credentials))
        {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'ttl' => Config::get('jwt.ttl'),
            'refresh_ttl' => Config::get('jwt.refresh_ttl'),
            'user' => UserResource::make(auth()->user()),
        ]);
    }
}
