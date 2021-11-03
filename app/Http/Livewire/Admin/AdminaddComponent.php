<?php

namespace App\Http\Livewire\Admin;

use App\Models\Role;
use App\Models\role_user;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AdminaddComponent extends Component
{
    public $name;
    public $email;
    public $password;
    public $role_id;
    public $utype = 'ADM';

    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role_id' =>'required'
        ]);
    }

    public function storeAdmin(){
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role_id' =>'required'
        ]);
        $users = new User();
        $users->name = $this->name;
        $users->email = $this->email;
        $users->password = Hash::make($this->password);
        $users->utype = $this->utype;
        $users->save();
        $users->roles()->attach($this->role_id);
        session()->flash('message','Them admin thanh cong!');
    }
    public function render()
    {
        $roles = Role::all();
        return view('livewire.admin.adminadd-component',['roles'=>$roles])->layout('layouts.base');
    }
}