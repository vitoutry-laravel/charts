<?php

namespace Vitoutry\Charts\Factories;

use Vitoutry\Charts\Enums\Charts;

class Doughnut extends Circles
{
    public function __construct()
    {
        parent::__construct();

        $this->type(Charts::Doughnut)
            ->ratio(1);
    }
}
