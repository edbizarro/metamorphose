<?php

namespace PowerDataHub\Metamorphose;

use Illuminate\Pipeline\Pipeline;

class Metamorphose
{
    /**
     * @var mixed
     */
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

    /**
     * Metamorphose constructor.
     *
     * @param SourceConfig $sourceConfig
     */
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
     * @param string $sourceType
     *
     * @return $this
     */
    public function sourceType(string $sourceType): self
    {
        $this->sourceType = $sourceType;

        return $this;
    }

    /**
     * @param mixed $transformers
     * @param array $sourceTransformers
     *
     * @return $this
     */
    public function through($transformers, array $sourceTransformers = []): self
    {
        $this->defaultTransformers = (array) $transformers;
        $this->sourceConfig->load($sourceTransformers);

        return $this;
    }

    public function transform()
    {
        return $this->applySource(
            $this->applyDefault($this->from)
        );
    }

    protected function applyDefault($values)
    {
        return $this->apply(
            $this->defaultTransformers,
            $values,
            'default'
        );
    }

    protected function applySource($values)
    {
        return $this->apply(
            $this->sourceConfig->getBySource($this->sourceType),
            $values,
            'source'
        );
    }

    /**
     * @param array $transformers
     * @param array $values
     * @param string $type
     *
     * @return array
     */
    protected function apply(array $transformers, $values, string $type)
    {
        if (\count($transformers) === 0) {
            return $values;
        }

        return app(Pipeline::class)
            ->send([
                'data' => $values,
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
