<?php

namespace PowerDataHub\Metamorphose\Interfaces;

use Closure;

interface TransformInterface
{
    public function transform($content);

    public function handle($content, Closure $next);
}
