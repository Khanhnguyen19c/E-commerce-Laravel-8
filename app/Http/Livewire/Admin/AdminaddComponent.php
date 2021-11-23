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
            'password' => 'required|min:8',
            'role_id' =>'required'
        ]);
    }
    protected $messages = [
        'name.required' => 'Thông tin này không được bỏ trống.',
        'slug.required' => 'Thông tin này không được bỏ trống.',
        'email.email' => 'Bạn phải nhập Định dạng Email vào ô này.',
        'password.required'=> 'Mật khẩu không được để trống.'
    ];
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
        session()->flash('message','Them admin thành công!');
        $this->reset();
    }
    public function render()
    {
        $roles = Role::all();
        return view('livewire.admin.adminadd-component',['roles'=>$roles])->layout('layouts.base');
    }
}
