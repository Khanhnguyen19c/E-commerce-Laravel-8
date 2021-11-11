<?php

namespace App\Http\Livewire\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AdmineditComponent extends Component
{
    public $admin_id;
    public $name;
    public $email;
    public $old_password;
    public $password;
    public $password_confirmation;
    public $role_id;
    public $utype = 'ADM';

    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required',
            'old_password' => 'required|min:8',
            'password' => 'required|min:8|confirmed|different:old_password',
            'role_id' =>'required'
        ]);
    }
    protected $messages = [
        'name.required' => 'Thông tin này không được bỏ trống.',
        'old_password.required' => 'Thông tin này không được bỏ trống.',
        'password.email' => 'Bạn phải nhập Định dạng Email vào ô này.',
        'password.required'=> 'Mật khẩu không được để trống.'
    ];
    public function mount($id){
    $user = User::find($id);
    $this->name= $user->name;
    $this->email= $user->email;
    $this->role_id= $user->role_id;
    $this->admin_id = $id;
    }

    public function storeAdmin(){
        $this->validate([
            'name' => 'required',
            'old_password' => 'required|min:8',
            'password' => 'required|min:8|confirmed|different:old_password',
            'role_id' =>'required'
        ]);
        $user = User::find($this->admin_id);
        if(Hash::check($this->old_password,$user->password)){
                $user->name = $this->name;
                $user->password = Hash::make($this->password);
                $user->utype = $this->utype;
                $user->save();
                $user->roles()->attach($this->role_id);
                session()->flash('message','Update admin thành công!');
            }else{
                session()->flash('message','Đổi Password thất bại!');
        }
    }
    public function render()
    {
        $roles = Role::all();
        return view('livewire.admin.adminedit-component',['roles'=>$roles])->layout('layouts.base');
    }
}
