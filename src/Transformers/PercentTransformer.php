<?php

namespace PowerDataHub\Metamorphose\Transformers;

use PowerDataHub\Metamorphose\BaseTransformer;

class PercentTransformer extends BaseTransformer
{
    public function transform($value, $original)
    {
        return round((float) $value, 2);
    }
}
