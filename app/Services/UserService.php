<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    public function __construct(
        protected readonly UserRepository $userRepository,
    ) {
    }

    public function create(array $data) : User
    {
        return $this->userRepository->create($data);
    }

}
