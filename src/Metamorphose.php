<?php

namespace PowerDataHub\Metamorphose;

use Illuminate\Pipeline\Pipeline;

class Metamorphose
{
    protected $from;

    /**
     * @var array
     */
    protected $defaultTransformers = [];

    /**
     * @var string|null
     */
    protected $sourceType;

    /**
     * @var SourceConfig
     */
    protected $sourceConfig;

    public function __construct(SourceConfig $sourceConfig)
    {
        $this->sourceConfig = $sourceConfig;
    }

    /**
     * @param array|string $from
     *
     * @return $this
     */
    public function from($from): self
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @param $sourceType
     *
     * @return $this
     */
    public function sourceType(string $sourceType): self
    {
        $this->sourceType = $sourceType;

        return $this;
    }

    /**
     * @param array $transformers
     *
     * @param array $sourceTransformers
     *
     * @return $this
     */
    public function through(array $transformers, array $sourceTransformers = []): self
    {
        $this->defaultTransformers = $transformers;

        if (\count($sourceTransformers) > 0) {
            $this->sourceConfig->load($sourceTransformers);
        }

        return $this;
    }

    public function transform()
    {
        if (\is_array($this->from)) {
            return collect($this->from)->map(function ($value, $key) {
                return $this->applySource($this->applyDefault($value, $key), $key);
            })->all();
        }

        return $this->applySource($this->applyDefault($this->from));
    }

    protected function applyDefault($value, $key = null): ?string
    {
        return $this->apply(
            $this->defaultTransformers,
            [$key => $value],
            'default'
        );
    }

    protected function applySource($value, $key = null): ?string
    {
        return $this->apply(
            $this->sourceConfig->getBySource($this->sourceType),
            [$key => $value],
            'source'
        );
    }

    protected function apply(array $transformers, array $value, string $type): ?string
    {
        $key = \key($value);
        $value = \array_values($value)[0];

        if (\count($transformers) === 0) {
            return $value;
        }

        return app(Pipeline::class)
            ->send([
                'data' => $value,
                'key' => $key,
                'source' => $this->sourceType,
                'sourceConfig' => $this->sourceConfig,
                'type' => $type,
            ])
            ->through($transformers)
            ->then(function ($data) {
                return $data;
            })['result'];
    }

    /**
     * @param array $configs
     */
    protected function parseConfig(array $configs): void
    {
        if (isset($configs['default'])) {
            $this->defaultTransformers = $configs['default'];
        }

        if (isset($configs['sources'])) {
            $this->sourceConfig->load($configs['sources']);
        }
    }
}
