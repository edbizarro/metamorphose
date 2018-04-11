<?php

namespace PowerDataHub\Metamorphose\Tests;

use PowerDataHub\Metamorphose\Metamorphose;

class MetamorphoseTest extends TestCase
{
    /** @test */
    public function it_can_transform()
    {
        $result = app(Metamorphose::class)
            ->with($this->defaultTransformers())
            ->transform(' text ');

        $this->assertEquals('text', $result);
    }

    /** @test */
    public function it_can_transform_with_source()
    {
        $result = app(Metamorphose::class)
            ->source('csv')
            ->with($this->defaultTransformers())
            ->transform(' text ');

        $this->assertEquals('text', $result);
    }
}
