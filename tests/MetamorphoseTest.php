<?php

namespace PowerDataHub\Metamorphose\Tests;

use PowerDataHub\Metamorphose\Metamorphose;
use PowerDataHub\Metamorphose\TransformPipeline;

class MetamorphoseTest extends TestCase
{
    /** @test */
    public function it_can_transform()
    {
        $result = app(Metamorphose::class)
            ->with([
                \PowerDataHub\Metamorphose\Base\TrimTransformer::class,
            ])
            ->source('csv')
            ->transform(' text ');

        $this->assertEquals('text', $result);
    }
}
