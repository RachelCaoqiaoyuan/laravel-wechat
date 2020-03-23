<?php

namespace Rachel\Wechat\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Rachel\Wechat\Console\Commands\ControllerMakeCommand;
use Rachel\Wechat\Http\Middleware\SWeChatCheck;

//用服务提供者注册自己组件的路由
class WechatServiceProvider extends ServiceProvider
{
    protected $routeMiddleware = [
        'swechat.check' => SWeChatCheck::class
    ];
    protected $middlewareGroups = [];
    protected $commands = [
        ControllerMakeCommand::class
    ];

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php','swechat'
        );
        $this->registerRouteMiddleware();
        $this->registerPublishing();
        $this->commands($this->commands);
    }

    public function registerPublishing()
    {
        // php artisan vendor:publish " 会运行这个PHP文件
        if ($this->app->runningInConsole()) { // 是不是在控制台运行
            // 可以发布配置文件到指定目录
            $this->publishes([__DIR__.'/../Config' => config_path('swechat')], 'swechat');//laravel的serviceprovider方法
        }
    }

    public function boot()
    {
        $this->registerRoutes();
        $this->loadViewsFrom(
            __DIR__.'/../Resources/views','swechat'
        );
    }

    private function routeConfiguration()
    {
        return [
            'namespace' => 'Rachel\Wechat\Http\Controllers',
            'prefix' => 'swechat',
        ];
    }

    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
        });
    }

    protected function registerRouteMiddleware()
    {
        foreach ($this->middlewareGroups as $key => $middleware) {
            $this->app['router']->middlewareGroup($key, $middleware);
        }

        foreach ($this->routeMiddleware as $key => $middleware) {
            $this->app['router']->aliasMiddleware($key, $middleware);
        }
    }
}
