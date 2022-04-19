<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Sds\Application\Account\UserLogin\LoginDto;
use Sds\Application\Account\UserLogin\LoginServiceInterface;

final class LoginController
{
    public function __construct(
        private readonly LoginServiceInterface $loginService
    ) { }

    public function __invoke(Request $request): JsonResource
    {
        $loginResponseDto = $this->loginService->login(new LoginDto(
            username: $request->get('username', ''),
            password: $request->get('password', ''),
            ipAddress: $request->ip()
        ));

        return new JsonResource([
            'token' => $loginResponseDto->token
        ]);
    }
}
