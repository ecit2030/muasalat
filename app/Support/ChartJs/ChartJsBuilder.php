<?php

namespace Support\ChartJs;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Blade;

class ChartJsBuilder
{
    /**
     * @var array
     */
    private $charts = [];

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $defaults = [
        'datasets' => [],
        'labels'   => [],
        'type'     => 'line',
        'options'  => [],
        'size'     => ['width' => null, 'height' => null],
    ];

    /**
     * @var array
     */
    private $types = [
        'bar',
        'horizontalBar',
        'bubble',
        'scatter',
        'doughnut',
        'line',
        'pie',
        'polarArea',
        'radar',
    ];

    /**
     * @param $name
     *
     * @return $this|ChartJsBuilder
     */
    public function name($name)
    {
        $this->name = $name;
        $this->charts[$name] = $this->defaults;

        return $this;
    }

    /**
     * @param $element
     *
     * @return ChartJsBuilder
     */
    public function element($element)
    {
        return $this->set('element', $element);
    }

    /**
     * @param  array  $labels
     *
     * @return ChartJsBuilder
     */
    public function labels(array $labels)
    {
        return $this->set('labels', $labels);
    }

    /**
     * @param  array  $datasets
     *
     * @return ChartJsBuilder
     */
    public function datasets(array $datasets)
    {
        return $this->set('datasets', $datasets);
    }

    /**
     * @param $type
     *
     * @return ChartJsBuilder
     */
    public function type($type)
    {
        if (! in_array($type, $this->types)) {
            throw new \InvalidArgumentException('Invalid Chart type.');
        }

        return $this->set('type', $type);
    }

    /**
     * @param  array  $size
     *
     * @return ChartJsBuilder
     */
    public function size($size)
    {
        return $this->set('size', $size);
    }

    /**
     * @param  array  $options
     *
     * @return $this|ChartJsBuilder
     */
    public function options(array $options)
    {
        foreach ($options as $key => $value) {
            $this->set('options.'.$key, $value);
        }

        return $this;
    }

    /**
     *
     * @param  string|array  $optionsRaw
     * @return \self
     */
    public function optionsRaw($optionsRaw)
    {
        if (is_array($optionsRaw)) {
            $this->set('optionsRaw', json_encode($optionsRaw, true));

            return $this;
        }

        $this->set('optionsRaw', $optionsRaw);

        return $this;
    }

    /**
     * @return mixed
     */
    public function render()
    {
        $chart = $this->charts[$this->name];

        return Blade::render(File::get(__DIR__.'/resources/views/chart-template.blade.php'), [
            'datasets'   => $chart['datasets'],
            'element'    => $this->name,
            'labels'     => $chart['labels'],
            'options'    => isset($chart['options']) ? $chart['options'] : '',
            'optionsRaw' => isset($chart['optionsRaw']) ? $chart['optionsRaw'] : '',
            'type'       => $chart['type'],
            'size'       => $chart['size'],
        ]);
    }

    public static function instance($name): self
    {
        return app(self::class)->name($name);
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    private function get($key)
    {
        return Arr::get($this->charts[$this->name], $key);
    }

    /**
     * @param $key
     * @param $value
     *
     * @return $this|ChartJsBuilder
     */
    private function set($key, $value)
    {
        Arr::set($this->charts[$this->name], $key, $value);

        return $this;
    }
}
