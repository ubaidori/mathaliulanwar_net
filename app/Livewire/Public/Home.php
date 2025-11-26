<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.guest')] // Memaksa pakai layout guest
class Home extends Component
{
    public function render()
    {
        return view('livewire.public.home');
    }
}