<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\ContactRepositoryInterface;
use App\Repositories\Eloquent\ContactRepository;
use App\Services\ContactService;

class ContactServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
        $this->app->singleton(ContactService::class, function ($app) {
            $repoContact = new ContactRepository();
			return new ContactService($repoContact);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
