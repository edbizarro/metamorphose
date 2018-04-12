<?php

namespace PowerDataHub\Metamorphose\Tests\Transformers\Base;

use PowerDataHub\Metamorphose\Metamorphose;
use PowerDataHub\Metamorphose\Tests\TestCase;

class DateTransformerTest extends TestCase
{
    /** @test */
    public function it_can_transform_a_date()
    {
        $result = app(Metamorphose::class)
            ->from('20170505')
            ->through([
                \PowerDataHub\Metamorphose\Base\DateTransformer::class
            ])
            ->transform();

        $this->assertEquals('2017-05-17', $result);
    }

    /** @test */
    public function it_can_apply_default_before_source_transformers()
    {
        $result = app(Metamorphose::class)
            ->from(['date' => ' 20170505 '])
            ->sourceType('ga')
            ->through(
                $this->defaultTransformers(),
                $this->sourcesTransformers()
            )
            ->transform();

        $this->assertEquals('2017-05-17', $result['date']);
    }
}
