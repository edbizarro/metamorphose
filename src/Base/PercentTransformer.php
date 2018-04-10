<?php

namespace PowerDataHub\Metamorphose\Base;

use PowerDataHub\Metamorphose\BaseTransformer;

class PercentTransformer extends BaseTransformer
{
    public function transform($content)
    {
        return round((float) $content, 2);
    }
}
