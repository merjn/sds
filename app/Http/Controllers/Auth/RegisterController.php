<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Sds\Application\Account\CreateUser\CreateUserDto;
use Sds\Application\Account\CreateUser\CreateUserServiceInterface;

final class RegisterController
{
    public function __construct(
        private readonly CreateUserServiceInterface $createUserService
    ) { }

    public function __invoke(Request $request): JsonResource
    {
        $createUserResponseDto = $this->createUserService->createUser(new CreateUserDto(
            username: $request->get('username', ''),
            password: $request->get('password', ''),
            email: $request->get('email', ''),
            ipAddress: $request->ip(),
            gender: 'M'
        ));

        return new JsonResource($createUserResponseDto);
    }
}
