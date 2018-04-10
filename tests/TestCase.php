<?php

namespace PowerDataHub\Metamorphose\Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return ['PowerDataHub\Metamorphose\MetamorphoseServiceProvider'];
    }
}
