<?php

namespace Hareku\LaravelFeedbackAPI;

use Illuminate\Support\ServiceProvider;

class LaravelFeedbackAPIServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Config
        $this->publishes([
            __DIR__.'/../config/feedback.php' => config_path('feedback.php'),
        ]);

        // Migration
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Route
        $this->loadRoutesFrom(__DIR__.'/../routes/feedback.php');

        // View
        $this->loadViewsFrom(__DIR__.'/../views', 'feedback');
        $this->publishes([
            __DIR__.'/../views' => resource_path('views/vendor/feedback'),
        ]);

        // Translation
        $this->loadTranslationsFrom(__DIR__.'/../translations/', 'feedback');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/feedback.php', 'feedback'
        );
    }
}
