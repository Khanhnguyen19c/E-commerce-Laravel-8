<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
class AdminEditBrandComponent extends Component
{
   
    public function render()
    {
        return view('livewire.admin.admin-edit-brand-component');
    }
}
