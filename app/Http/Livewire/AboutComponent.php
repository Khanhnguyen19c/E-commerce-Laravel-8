<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;

class AboutComponent extends Component
{
    public function render()
    {
        $settings = Setting::find(1);
        return view('livewire.about-component',['settings'=>$settings])->layout('layouts.base');
    }
}
