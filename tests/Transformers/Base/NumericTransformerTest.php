<?php

namespace PowerDataHub\Metamorphose\Tests\Transformers\Base;

use PowerDataHub\Metamorphose\Metamorphose;
use PowerDataHub\Metamorphose\Tests\TestCase;
use PowerDataHub\Metamorphose\Base\NumericTransformer;

class NumericTransformerTest extends TestCase
{
    /** @test */
    public function it_can_transform_a_string_into_a_number()
    {
        $this->assertInternalType(
            'int',
            app(Metamorphose::class)
                ->from('100')
                ->through(NumericTransformer::class)
                ->transform()
        );
    }
}
