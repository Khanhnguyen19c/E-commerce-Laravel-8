<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use App\Models\Setting;
use Livewire\Component;

class FooterComponent extends Component
{
    public function render()
    {
        $payments = Payment::all();
        $setting = Setting::find(1);
        return view('livewire.footer-component',['setting'=>$setting,'payments'=>$payments]);
    }
}
