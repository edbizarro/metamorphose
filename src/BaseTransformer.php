<?php

namespace PowerDataHub\Metamorphose;

use Closure;
use PowerDataHub\Metamorphose\Traits\Pipeable;
use PowerDataHub\Metamorphose\Interfaces\TransformInterface;

class BaseTransformer implements TransformInterface
{
    use Pipeable;

    /**
     * @param array $content
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($content, Closure $next)
    {
        $content['class'] = \get_class($this);

        $value = $content['result'] ?? $content['data'];
        $originalData = $content['all'] ?? [];

        switch ($content['type']) {
            case 'default':
                $value = $this->transform($value, $originalData);
                break;
            case 'source':
                $value = $this->applySourceTransformations(
                    $content,
                    $value,
                    $originalData
                );
                break;
        }

        $content['result'] = $value;

        return $next($content);
    }

    public function transform($field, $original)
    {
    }

    /**
     * @param array $params
     * @param $value
     *
     * @return mixed
     */
    protected function applySourceTransformations(array $params, $value, $completeData)
    {
        if ($this->shouldApplySourceTransformer($params['sourceConfig'], $params['source'], $params['key'])) {
            $value = $this->transform($value, $completeData);
        }

        return $value;
    }

    /**
     * @param SourceConfig $sourceConfig
     * @param $source
     * @param $key
     *
     * @return bool
     */
    protected function shouldApplySourceTransformer(SourceConfig $sourceConfig, $source, $key): bool
    {
        return $sourceConfig->getBySourceAndKey($source, $key) === \get_class($this);
    }
}
