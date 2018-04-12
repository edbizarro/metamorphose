<?php

namespace PowerDataHub\Metamorphose;

use PowerDataHub\Metamorphose\Interfaces\TransformInterface;
use PowerDataHub\Metamorphose\Traits\Pipeable;
use Closure;

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

        $data = $content['result'] ?? $content['data'];

        switch ($content['type']) {
            case 'default':
                $data = $this->transform($data);
                break;
            case 'source':
                $data = $this->applySourceTransformations(
                    $content,
                    $data
                );
                break;
            default:
                dd('default');
                break;
        }

        $content['result'] = $data;

        return $next($content);
    }

    public function transform($content)
    {
    }

    /**
     * @param array $params
     * @param $value
     *
     * @return mixed
     */
    protected function applySourceTransformations(array $params, $value)
    {
        if ($this->shouldApplySourceTransformer($params['sourceConfig'], $params['source'], $params['key'])) {
            $value = $this->transform($value);
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
