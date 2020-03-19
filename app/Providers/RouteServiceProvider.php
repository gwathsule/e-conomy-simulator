<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    public const HOME = '/home';

    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();

        /** Domains routes */
        $this->mapDomainRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    /** Domains routes */
    private function mapDomainRoutes()
    {
        $pathDomains = 'app/Domains/';
        $defaultRouteFile = '/routes.php';
        Route::middleware('api')->group(base_path($pathDomains . 'Banco' . $defaultRouteFile));
        Route::middleware('api')->group(base_path($pathDomains . 'Conta' . $defaultRouteFile));
        Route::middleware('api')->group(base_path($pathDomains . 'Contrato' . $defaultRouteFile));
        Route::middleware('api')->group(base_path($pathDomains . 'Empresa' . $defaultRouteFile));
        Route::middleware('api')->group(base_path($pathDomains . 'Emprestimo' . $defaultRouteFile));
        Route::middleware('api')->group(base_path($pathDomains . 'Familia' . $defaultRouteFile));
        Route::middleware('api')->group(base_path($pathDomains . 'Governo' . $defaultRouteFile));
        Route::middleware('api')->group(base_path($pathDomains . 'Pessoa' . $defaultRouteFile));
        Route::middleware('api')->group(base_path($pathDomains . 'Titulo' . $defaultRouteFile));
    }
}
