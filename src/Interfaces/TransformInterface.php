<?php

namespace PowerDataHub\Metamorphose\Interfaces;

use Closure;

interface TransformInterface
{
    public function transform($field, $original);

    public function handle($content, Closure $next);
}
