<?php

namespace PowerDataHub\Metamorphose\Transformers;

use PowerDataHub\Metamorphose\BaseTransformer;

class TrimTransformer extends BaseTransformer
{
    public function transform($value)
    {
        if (\is_array($value)) {
            foreach ($value as $key => $item) {
                $value[$key] = trim($item);
            }

            return $value;
        }

        return trim($value);
    }
}
