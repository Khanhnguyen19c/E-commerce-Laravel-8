<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use App\Models\Setting;
use Illuminate\Http\Request;
use Livewire\Component;

class FooterComponent extends Component
{
    protected $listeners = ['refreshComponent'=>'$refresh'];
    public function render()
    {
        return view('livewire.footer-component');
    }
}
