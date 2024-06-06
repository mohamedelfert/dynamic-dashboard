<?php

namespace Modules\UserPreferences\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class UserPreferencesServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('UserPreferences', 'Database/Migrations'));
        app()->make('router')->aliasMiddleware('HasUserPreferencesModule', \Modules\UserPreferences\Http\Middleware\HasUserPreferencesModule::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('UserPreferences', 'Config/config.php') => config_path('userpreferences.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('UserPreferences', 'Config/config.php'), 'userpreferences'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/userpreferences');

        $sourcePath = module_path('UserPreferences', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/userpreferences';
        }, \Config::get('view.paths')), [$sourcePath]), 'userpreferences');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/userpreferences');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'userpreferences');
        } else {
            $this->loadTranslationsFrom(module_path('UserPreferences', 'Resources/lang'), 'userpreferences');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('UserPreferences', 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
