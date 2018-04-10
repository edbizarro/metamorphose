<?php

namespace PowerDataHub\Metamorphose\Tests;

use PowerDataHub\Metamorphose\TransformPipeline;

class TransformPipelineTest extends TestCase
{

    /** @test */
    public function it_can_transform_string()
    {
        $result = (new TransformPipeline(' text ', 'csv', [
            'default' => [
                \PowerDataHub\Metamorphose\Base\TrimTransformer::class,
            ],
        ]))->run();

        $this->assertEquals('text', $result);
    }
}
