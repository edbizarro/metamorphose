<?php

namespace PowerDataHub\Metamorphose\Tests;

use Orchestra\Testbench\TestCase as OrchestraTest;
use PowerDataHub\Metamorphose\MetamorphoseServiceProvider;

abstract class TestCase extends OrchestraTest
{
    protected function getPackageProviders($app)
    {
        return [
            MetamorphoseServiceProvider::class,
        ];
    }

    protected function defaultTransformers()
    {
        return [
            \PowerDataHub\Metamorphose\Base\TrimTransformer::class,
        ];
    }

    protected function sourcesTransformers()
    {
        return [
            'ga' => [
                'bounceRate' => \PowerDataHub\Metamorphose\Base\PercentTransformer::class,
                'sessions' => \PowerDataHub\Metamorphose\Base\NumericTransformer::class,
                'avgSessionDuration' => \PowerDataHub\Metamorphose\Base\NumericTransformer::class,
                'date' => \PowerDataHub\Metamorphose\Base\DateTransformer::class,
            ],
        ];
    }
}
