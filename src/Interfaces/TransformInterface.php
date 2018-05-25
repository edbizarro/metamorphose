<?php

namespace PowerDataHub\Metamorphose\Interfaces;

use Closure;

interface TransformInterface
{
    public function transform($field);

    public function handle($content, Closure $next);
}
