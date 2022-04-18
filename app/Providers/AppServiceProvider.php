<?php

namespace App\Providers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Sds\Application\Account\Hashing\HashService;
use Sds\Application\Account\Hashing\Interfaces\HasherInterface;
use Sds\Application\Account\Hashing\Interfaces\HashServiceInterface;
use Sds\Application\Account\Hashing\PasswordOptions;
use Sds\Application\Account\UserLogin\Authenticator\AuthenticatorInterface;
use Sds\Application\Interfaces\EventDispatcherInterface;
use Sds\Infrastructure\Auth\PassportAuthenticator;
use Sds\Infrastructure\Event\LaravelEventDispatcher;
use Sds\Infrastructure\Hashing\Hasher;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerEventDispatcher();
        $this->registerAuthComponent();
        $this->registerHashingComponent();
    }

    private function registerEventDispatcher(): void
    {
        $this->app->bind(EventDispatcherInterface::class, LaravelEventDispatcher::class);
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
}
