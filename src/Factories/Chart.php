<?php

namespace Vitoutry\Charts\Factories;

abstract class Chart
{
    protected  string $name;
    protected array $datasets;
    protected array $labels;
    protected array $colors;
    protected array $data;
    protected string $title;
    protected string $type;
    protected array $options;

    public function __construct()
    {
        $this->data = [];
        $this->options = [];
        $this->colors();
    }

    public function get()
    {
        $this->build();

        return $this->response();
    }

    public function title(string $title)
    {
        $this->title = $title;

        return $this;
    }

    public function labels(array $labels)
    {
        $this->labels = $labels;

        return $this;
    }

    public function datasets(array $datasets)
    {
        $this->datasets = $datasets;

        return $this;
    }

    public function ratio(float $ratio)
    {
        $this->options['aspectRatio'] = $ratio;

        return $this;
    }

    public function option($option, $value)
    {
        $this->options[$option] = $value;

        return $this;
    }

    abstract protected function build();

    abstract protected function response();

    protected function type(string $type)
    {
        $this->type = $type;

        return $this;
    }

    protected function hex2rgba($color)
    {
        $color = substr($color, 1);

        $hex = [
            "{$color[0]}{$color[1]}",
            "{$color[2]}{$color[3]}",
            "{$color[4]}{$color[5]}",
        ];

        $rgb = array_map('hexdec', $hex);
        $rgba = implode(',', $rgb);
        $opacity = config('vitoutry.charts.fillBackgroundOpacity');

        return "rgba({$rgba},{$opacity})";
    }

    protected function color($index = null)
    {
        $index ??= count($this->data);

        return $this->colors[$index];
    }

    protected function colors()
    {
        return $this->colors = array_values(config('vitoutry.charts.colors'));
    }

    protected function scales()
    {
        $this->options['scales'] = [
            'xAxes' => [[
                'ticks' => [
                    'autoSkip' => false,
                    'maxRotation' => 90,
                ],
                'gridLines' => ['drawOnChartArea' => false],
            ]],
            'yAxes' => [['gridLines' => ['drawOnChartArea' => false]]],
        ];
    }


    /**
     * @return mixed
     */
    public function render()
    {
//        $chart = $this->charts[$this->name];

        return view('chart-template::chart-template')
            ->with('datasets', $this->$datasets)
            ->with('element', $this->name)
            ->with('labels', $this->labels)
            ->with('options', isset($this->options) ? $this->options : '')
            ->with('optionsRaw', isset($this->optionsRaw) ? $this->optionsRaw : '')
            ->with('type', $this->type)
            ->with('size', $this->size)
            ->with('title',$this->title);

    }

}
