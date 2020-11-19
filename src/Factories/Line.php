<?php

namespace Vitoutry\Charts\Factories;

use Illuminate\Support\Collection;
use Vitoutry\Charts\Enums\Charts;

class Line extends Chart
{
    private $fill;

    public function __construct()
    {
        parent::__construct();

        $this->fill = false;

        $this->type(Charts::Line)
            ->ratio(1.6)
            ->scales();
    }

    public function response()
    {
        return [
            'data' => [
                'labels' => $this->labels,
                'datasets' => $this->data,
            ],
            'options' => $this->options,
            'title' => $this->title,
            'type' => $this->type,
        ];
    }

    public function fill()
    {
        $this->fill = true;

        return $this;
    }

    protected function build()
    {
        (new Collection($this->datasets))
            ->each(fn ($dataset, $label) => $this->data[] = [
                'fill' => $this->fill,
                'lineTension' => 0.3,
                'pointHoverRadius' => 5,
                'pointHitRadius' => 5,
                'label' => $label,
                'borderColor' => $this->color(),
                'backgroundColor' => $this->hex2rgba($this->color()),
                'data' => $dataset,
                'datalabels' => ['backgroundColor' => $this->color()],
            ]);
    }
}
