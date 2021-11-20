<?php

namespace App\Http\Livewire\Admin;

use App\Models\Permission;
use Livewire\Component;

class AdminPermissonsConponent extends Component
{

    public function render()
    {
        return view('livewire.admin.admin-permissons-conponent')->layout('layouts.base');
    }
}
