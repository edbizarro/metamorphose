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
            \PowerDataHub\Metamorphose\Transformers\TrimTransformer::class,
        ];
    }

    protected function sourcesTransformers()
    {
        return [
            'ga' => [
                'bounceRate' => \PowerDataHub\Metamorphose\Transformers\PercentTransformer::class,
                'sessions' => \PowerDataHub\Metamorphose\Transformers\NumericTransformer::class,
                'avgSessionDuration' => \PowerDataHub\Metamorphose\Transformers\NumericTransformer::class,
                'date' => \PowerDataHub\Metamorphose\Transformers\DateTransformer::class,
            ],
        ];
    }

    protected function sourcesTransformersWithDuplicates()
    {
        return [
            'ga' => [
                'sessions' => \PowerDataHub\Metamorphose\Transformers\NumericTransformer::class,
                'users' => \PowerDataHub\Metamorphose\Transformers\NumericTransformer::class,
                'clicks' => \PowerDataHub\Metamorphose\Transformers\NumericTransformer::class,
                'avgSessionDuration' => \PowerDataHub\Metamorphose\Transformers\NumericTransformer::class,
            ],
        ];
    }
}
