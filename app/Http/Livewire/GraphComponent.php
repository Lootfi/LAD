<?php

namespace App\Http\Livewire;

use Livewire\Component;

abstract class GraphComponent extends Component
{
    public $data;

    public abstract function updateGraphData();

    public abstract function getNewData();
}
