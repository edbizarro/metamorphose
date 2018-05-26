<?php

namespace PowerDataHub\Metamorphose\Tests\Transformers\Base;

use PowerDataHub\Metamorphose\Metamorphose;
use PowerDataHub\Metamorphose\Tests\TestCase;
use PowerDataHub\Metamorphose\Transformers\TrimTransformer;

class TrimTransformerTest extends TestCase
{
    /** @test */
    public function it_can_apply_trim()
    {
        $result = app(Metamorphose::class)
            ->from(' 100 ')
            ->through(TrimTransformer::class)
            ->transform();

        $this->assertEquals('100', $result);
        $this->assertInternalType('string', $result);
    }
}
