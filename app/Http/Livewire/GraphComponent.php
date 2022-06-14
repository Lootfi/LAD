<?php

namespace App\Http\Livewire;

use Livewire\Component;

abstract class GraphComponent extends Component
{
    public $data;

    abstract public function updateGraphData();

    abstract public function getNewData();
}
