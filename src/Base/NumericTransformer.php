<?php

namespace PowerDataHub\Metamorphose\Base;

use PowerDataHub\Metamorphose\BaseTransformer;

class NumericTransformer extends BaseTransformer
{
    public function transform($content)
    {
        return (int) $content;
    }
}
