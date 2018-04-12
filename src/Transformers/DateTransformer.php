<?php

namespace PowerDataHub\Metamorphose\Transformers;

use Cake\Chronos\Chronos;
use PowerDataHub\Metamorphose\BaseTransformer;

class DateTransformer extends BaseTransformer
{
    public function transform($value, $original)
    {
        return Chronos::createFromFormat('Ymd', $value)->format('Y-m-y');
    }
}
