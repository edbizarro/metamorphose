<?php

namespace PowerDataHub\Metamorphose\Base;

use PowerDataHub\Metamorphose\BaseTransformer;

class TrimTransformer extends BaseTransformer
{
    public function transform($content)
    {
        return trim($content);
    }
}
