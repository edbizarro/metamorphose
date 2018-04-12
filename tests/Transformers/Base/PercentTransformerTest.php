<?php

namespace PowerDataHub\Metamorphose\Tests\Transformers\Base;

use PowerDataHub\Metamorphose\Metamorphose;
use PowerDataHub\Metamorphose\Tests\TestCase;

class PercentTransformerTest extends TestCase
{
    /** @test */
    public function it_can_round_a_number()
    {
        $result = app(Metamorphose::class)
            ->from(100.987)
            ->through([
                \PowerDataHub\Metamorphose\Transformers\PercentTransformer::class,
            ])
            ->transform();

        $this->assertEquals(100.99, $result);
        $this->assertTrue(is_float($result));
    }

    /** @test */
    public function it_can_round_a_string()
    {
        $result = app(Metamorphose::class)
            ->from('100.987')
            ->through([
                \PowerDataHub\Metamorphose\Transformers\PercentTransformer::class,
            ])
            ->transform();

        $this->assertEquals(100.99, $result);
        $this->assertInternalType('float', $result);
    }
}
