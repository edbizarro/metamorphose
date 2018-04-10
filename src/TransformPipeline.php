<?php

namespace PowerDataHub\Metamorphose;

use Illuminate\Pipeline\Pipeline;

class TransformPipeline
{
    /**
     * @var array
     */
    protected $defaultTransformers = [];

    /**
     * @var array
     */
    protected $data;

    /**
     * @var string
     */
    protected $source;

    /**
     * @var
     */
    protected $sourcesConfig = [];

    /**
     * TransformPipelineService constructor.
     *
     * @param $data
     * @param string $etlJob
     */
    public function __construct($data, string $source, $configs = [])
    {
//        $this->loadTransformConfig();
        $this->parseConfig($configs);

        $this->data = $this->normalizeDataKeys($data);
        $this->source = $source;
    }

    /**
     * @param $data
     * @param string $source
     *
     * @return static
     */
    public static function create($data, string $source)
    {
        return new static($data, $source);
    }

    public function run()
    {
        $sourceTransformers = collect($this->getConfigBySource())
            ->values()
            ->unique()
            ->all();

        $result = app(Pipeline::class)
            ->send([
                'data' => $this->data,
                'sourceConfig' => $this->getConfigBySource(),
                'defaultConfig' => $this->defaultTransformers
            ])
            ->through(array_merge($this->defaultTransformers, $sourceTransformers))
            ->then(function ($data) {
                return $data;
            });

        return $result['data'] ?? $result;
    }

    protected function loadTransformConfig(): void
    {
        $this->defaultTransformers = config('transformers.default');
        $this->sourcesConfig = config('transformers.sources.'.$this->source) ?? [];
    }

    /**
     * @return array
     */
    protected function getConfigBySource(): array
    {
        return (count($this->sourcesConfig) > 0) ? $this->sourcesConfig : [] ;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    protected function normalizeDataKeys($data)
    {
        if (is_array($data)) {
            return array_change_key_case($data, CASE_LOWER);
        }

        return $data;
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
            $this->sourcesConfig = $configs['sources'][$this->source] ?? [];
        }
    }
}
