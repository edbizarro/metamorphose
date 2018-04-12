<?php

namespace PowerDataHub\Metamorphose\Transformers;

use PowerDataHub\Metamorphose\BaseTransformer;

class NumericTransformer extends BaseTransformer
{
    public function transform($value, $original)
    {
        return (int) $value;
    }
}
