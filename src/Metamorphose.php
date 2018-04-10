<?php

namespace PowerDataHub\Metamorphose;

class Metamorphose
{
    public function transform($data, $source)
    {
        return TransformPipeline::create(
            $data,
            $source
        )->run();
    }
}
