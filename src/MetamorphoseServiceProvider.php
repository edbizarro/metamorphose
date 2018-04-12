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
    public function boot(): void
    {
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->configure();
        $this->offerPublishing();

        $this->app->bind(Metamorphose::class, function ($app) {
            return $this->createInstance();
        });

        $this->app->singleton('metamorphose', function ($app) {
            return $this->createInstance();
        });
    }

    protected function configure(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/transformers.php',
            'transformers'
        );
    }

    protected function offerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/transformers.php' => config_path('transformers.php'),
            ], 'pdh-transformers');
        }
    }

    /**
     * @return Metamorphose
     */
    protected function createInstance(): Metamorphose
    {
        return (new Metamorphose(
            new SourceConfig(config('transformers.sources'))
        ))->through(
            config('transformers.default')
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['metamorphose'];
    }
}
