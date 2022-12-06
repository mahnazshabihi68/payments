<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * @return void
     */
    public function map(): void
    {
        $this->mapUserAPIRoutes()
            ->mapAdminAPIRoutes();
    }

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

//        $this->routes(function () {
//            Route::middleware('api')
//                ->prefix('api')
//                ->group(base_path('routes/api.php'));
//
//            Route::middleware('web')
//                ->group(base_path('routes/web.php'));
//        });
    }

    /**
     * Define the "api" routes for the user endpoints.
     *
     * These routes are typically stateless.
     *
     * @return $this
     */
    protected function mapUserAPIRoutes(): self
    {
        Route::prefix('api/v1/user')
            ->middleware('api')
            ->group(base_path('routes/API/V1/user.php'));
        return $this;
    }

    /**
     * Define the "api" routes for the admin endpoints.
     *
     * These routes are typically stateless.
     *
     * @return $this
     */
    protected function mapAdminAPIRoutes(): self
    {
        Route::prefix('api/v1/admin')
            ->middleware('api')
            ->group(base_path('routes/API/V1/admin.php'));
        return $this;
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
