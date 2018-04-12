<?php

namespace PowerDataHub\Metamorphose;

use Illuminate\Support\Arr;

class SourceConfig
{
    /**
     * @var array
     */
    protected $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * @param array $config
     *
     * @return SourceConfig
     */
    public function load(array $config): self
    {
        $this->config = $config;

        return $this;
    }

    public function getBySource($source): array
    {
        if (Arr::has($this->config, $source) === false) {
            return [];
        }

        $sourceTransformers = collect($this->config[$source])
            ->unique()
            ->all();

        return $sourceTransformers;
    }

    public function getBySourceAndKey($source, $key)
    {
        if (Arr::has($this->config, $source) === false) {
            return [];
        }

        $sourceTransformers = collect($this->config[$source])
            ->unique();

        return $sourceTransformers->get($key);
    }
}
