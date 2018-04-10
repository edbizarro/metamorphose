<?php

namespace PowerDataHub\Metamorphose\Base;

use PowerDataHub\Metamorphose\BaseTransformer;
use Cake\Chronos\Chronos;

class DateTransformer extends BaseTransformer
{
    public function transform($content)
    {
        return Chronos::createFromFormat('Ymd', $content)->format('Y-m-y');
    }
}
