<?php

namespace PowerDataHub\Metamorphose\Base;

use Cake\Chronos\Chronos;
use PowerDataHub\Metamorphose\BaseTransformer;

class DateTransformer extends BaseTransformer
{
    public function transform($content)
    {
        return Chronos::createFromFormat('Ymd', $content)->format('Y-m-y');
    }
}
