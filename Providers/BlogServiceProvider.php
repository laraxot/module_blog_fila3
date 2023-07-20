<?php

declare(strict_types=1);

namespace Modules\Blog\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Request;
use Modules\Tenant\Services\TenantService;
use Modules\Xot\Providers\XotBaseServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use BezhanSalleh\FilamentLanguageSwitch\Http\Middleware\SwitchLanguageLocale;
use Illuminate\Routing\Router;

class BlogServiceProvider extends XotBaseServiceProvider
{
    protected string $module_dir = __DIR__;

    protected string $module_ns = __NAMESPACE__;

    public string $module_name = 'blog';

    public function bootCallback(): void
    {
        //$kernel = $this->app->make('Illuminate\Contracts\Http\Kernel');
        //$kernel->pushMiddleware(SwitchLanguageLocale::class);
        $router = app('router');
        $this->registerMyMiddleware($router);
    }



    public function registerCallback(): void
    {
    }

    public function registerMyMiddleware(Router $router): void
    {
        // $router->pushMiddlewareToGroup('web', SetDefaultLocaleForUrlsMiddleware::class);
        $router->pushMiddlewareToGroup('web', SwitchLanguageLocale::class);
        //$router->appendMiddlewareToGroup('api', SwitchLanguageLocale::class);
    }
}
