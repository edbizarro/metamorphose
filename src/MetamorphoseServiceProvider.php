<?php

namespace PowerDataHub\Metamorphose;

use Illuminate\Support\ServiceProvider;

class MetamorphoseServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->configure();
        $this->offerPublishing();

        $this->app->singleton(Metamorphose::class);
    }

    protected function configure()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/transformers.php',
            'transformers'
        );
    }

    protected function offerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/transformers.php' => config_path('transformers.php'),
            ], 'pdh-transformers');
        }
    }

    /**
     * @return bool
     */
    private function isLumen()
    {
        return true === str_contains($this->app->version(), 'Lumen');
    }
}
