<?php

declare(strict_types=1);

namespace Modules\Blog\Providers;

use BezhanSalleh\FilamentLanguageSwitch\Http\Middleware\SwitchLanguageLocale;
use Illuminate\Routing\Router;
use Modules\Xot\Providers\XotBaseRouteServiceProvider;

class RouteServiceProvider extends XotBaseRouteServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     */
    protected string $moduleNamespace = 'Modules\Blog\Http\Controllers';

    protected string $module_dir = __DIR__;

    protected string $module_ns = __NAMESPACE__;

    public function bootCallback(): void
    {
        // 36     Cannot access offset 'router' on Illuminate\Contracts\Foundation\Application
        // $router = $this->app['router'];
        // $router = app('router');
        // dddx([$router, $router1]);

        // $this->registerLang();
        // $this->registerRoutePattern($router);
        // $this->registerMyMiddleware($router);
    }

    public function registerCallback(): void
    {
        // dddx('b');
    }

    // public function registerMyMiddleware(Router $router): void
    // {
    // $router->pushMiddlewareToGroup('web', SetDefaultLocaleForUrlsMiddleware::class);
    // $router->appendMiddlewareToGroup('web', SwitchLanguageLocale::class);
    // $router->appendMiddlewareToGroup('api', SwitchLanguageLocale::class);
    // }
}
