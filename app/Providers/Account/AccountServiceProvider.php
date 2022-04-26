<?php

namespace App\Providers\Account;

use Illuminate\Support\ServiceProvider;
use LaravelDoctrine\ORM\Facades\EntityManager;
use Sds\Application\Account\CreateUser\CreateUserService;
use Sds\Application\Account\CreateUser\CreateUserServiceInterface;
use Sds\Application\Account\Hashing\HashService;
use Sds\Application\Account\Hashing\Interfaces\HasherInterface;
use Sds\Application\Account\Hashing\Interfaces\HashServiceInterface;
use Sds\Application\Account\Hashing\PasswordOptions;
use Sds\Application\Account\UserLogin\Authenticator\AuthenticatorInterface;
use Sds\Application\Account\UserLogin\LoginService;
use Sds\Application\Account\UserLogin\LoginServiceInterface;
use Sds\Application\Repositories\UserRepositoryInterface;
use Sds\Domain\Models\User;
use Sds\Infrastructure\Account\UserLogin\Authenticator\PassportAuthenticator;
use Sds\Infrastructure\Database\Repositories\UserRepository;
use Sds\Infrastructure\Hashing\Hasher;

class AccountServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerAuthComponent();
        $this->registerHashingComponent();
        $this->registerLoginService();
        $this->registerCreateUserComponent();
    }

    private function registerAuthComponent(): void
    {
        $this->app->bind(AuthenticatorInterface::class, PassportAuthenticator::class);
    }

    private function registerHashingComponent()
    {
        $this->app->bind(HasherInterface::class, Hasher::class);
        $this->app->singleton(PasswordOptions::class, fn () => new PasswordOptions(secretKey: config('password.aes_key')));
        $this->app->bind(HashServiceInterface::class, HashService::class);
    }

    private function registerLoginService()
    {
        $this->app->bind(LoginServiceInterface::class, LoginService::class);
        $this->app->bind(UserRepositoryInterface::class, fn () => new UserRepository(EntityManager::getRepository(User::class)));
    }

    private function registerCreateUserComponent()
    {
        $this->app->bind(CreateUserServiceInterface::class, CreateUserService::class);
    }
}
