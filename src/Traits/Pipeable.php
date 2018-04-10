<?php

namespace PowerDataHub\Metamorphose\Traits;

use Closure;

/**
 * Trait Pipeable
 */
trait Pipeable
{
    public function handle($content, Closure $next)
    {
        return  $next($this->transform($content));
    }
}
