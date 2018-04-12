<?php

namespace PowerDataHub\Metamorphose\Transformers;

use PowerDataHub\Metamorphose\BaseTransformer;

class TrimTransformer extends BaseTransformer
{
    public function transform($value, $original)
    {
        return trim($value);
    }
}
