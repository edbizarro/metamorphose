<?php

namespace PowerDataHub\Metamorphose\Transformers;

use PowerDataHub\Metamorphose\BaseTransformer;

class PercentTransformer extends BaseTransformer
{
    public function transform($value)
    {
        return round((float) $value, 2);
    }
}
