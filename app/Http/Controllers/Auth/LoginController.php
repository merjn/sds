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
        $loginViewModel = $this->loginService->login(new LoginDto(
            username: $request->get('username', ''),
            password: $request->get('password', '')
        ));

        return new JsonResource([
            'token' => $loginViewModel->token
        ]);
    }
}
