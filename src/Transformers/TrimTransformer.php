<?php

namespace PowerDataHub\Metamorphose\Transformers;

use PowerDataHub\Metamorphose\BaseTransformer;

class TrimTransformer extends BaseTransformer
{
    public function transform($value)
    {
        return trim($value);
    }
}
