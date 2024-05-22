<?php

namespace App\Livewire;

use Livewire\Component;

class Games extends Component
{
    public $showGame = false;

    public function loadGame()
    {
        $this->showGame = true;
    }

    public function render()
    {
        return view('livewire.games');
    }
}
