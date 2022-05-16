<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use League\Tactician\CommandBus;
use Sds\Application\Account\UserLogin\AuthenticatePlayer;

final class LoginController
{
    public function __construct(
        private readonly CommandBus $commandBus
    ) { }

    public function __invoke(Request $request): JsonResource
    {
        $loginResponseDto = $this->commandBus->handle(new AuthenticatePlayer(
            username: $request->input('username', ''),
            password: $request->input('password', ''),
            ipAddress: $request->ip()
        ));

        return new JsonResource([
            'token' => $loginResponseDto->token
        ]);
    }
}
