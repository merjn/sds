<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use LaravelDoctrine\ORM\Facades\EntityManager;
use Sds\Application\Account\UserLogin\LoginService;
use Sds\Application\Account\UserLogin\LoginServiceInterface;
use Sds\Application\Repositories\UserRepositoryInterface;
use Sds\Domain\Models\User;
use Sds\Infrastructure\Database\Repositories\UserRepository;

class LoginServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LoginServiceInterface::class, LoginService::class);

        $this->app->bind(UserRepositoryInterface::class, fn () => new UserRepository(EntityManager::getRepository(User::class)));
    }
}
