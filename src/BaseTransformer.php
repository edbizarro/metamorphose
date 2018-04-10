<?php

namespace PowerDataHub\Metamorphose;

use PowerDataHub\Metamorphose\Interfaces\TransformInterface;
use PowerDataHub\Metamorphose\Traits\Pipeable;
use Closure;
use Illuminate\Support\Arr;

class BaseTransformer implements TransformInterface
{
    use Pipeable;

    protected $sourceConfig;
    protected $defaultConfig;
    protected $clientConfig;

    public function handle(array $content, Closure $next)
    {
        if (is_array($content['data']) === false) {
            return $next($this->transform($content['data']));
        }

        $this->sourceConfig = $content['sourceConfig'];
        $this->defaultConfig = $content['defaultConfig'];
        $this->clientConfig = [];

        $content['data'] = collect($content['data'])->map(function ($value, $key) {
            if (! $this->shouldTransform($key)) {
                return $value;
            }

            $value = $this->applyDefaultTransformations($value, $key);
            $value = $this->applySourceTransformations($value, $key);
            $value = $this->applyClientTransformations($value, $key);

            return $value;
        })->all();

        return $next($content);
    }

    public function transform($content)
    {
        return $content;
    }

    /**
     * @param $key
     *
     * @return bool
     */
    protected function shouldTransform($key): bool
    {
        if (is_null(Arr::get($this->defaultConfig, $key)) &&
            is_null(Arr::get($this->sourceConfig, $key)) &&
            is_null(Arr::get($this->clientConfig, $key))
        ) {
            return false;
        }

        return true;
    }

    /**
     * @param $value
     * @param $key
     *
     * @return mixed
     */
    protected function applyDefaultTransformations($value, $key)
    {
        if (Arr::get($this->defaultConfig, $key) === \get_class($this)) {
            return $this->transform($value);
        }

        return $value;
    }

    /**
     * @param $value
     * @param $key
     *
     * @return mixed
     */
    protected function applySourceTransformations($value, $key)
    {
        if (Arr::get($this->sourceConfig, $key) === \get_class($this)) {
            $value = $this->transform($value);
        }

        return $value;
    }

    /**
     * @param $value
     * @param $key
     *
     * @return mixed
     */
    protected function applyClientTransformations($value, $key)
    {
        return $value;
    }
}
