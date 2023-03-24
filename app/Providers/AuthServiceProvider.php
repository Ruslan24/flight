<?php

namespace App\Providers;

use App\Http\Middleware\BasicAuthDriver;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
//        $this->registerPolicies();

        $this->app['auth']->viaRequest('basic', function ($request) {
            die(print_r('dfdfdfdf'));
            return new BasicAuthDriver();
        });
    }
}
