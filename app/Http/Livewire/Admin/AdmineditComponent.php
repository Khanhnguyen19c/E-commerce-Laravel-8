<?php

namespace App\Http\Livewire\Admin;

use App\Models\Role;
use App\Models\role_user;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AdmineditComponent extends Component
{
    public $admin_id;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role_id;
    public $utype = 'ADM';

    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required',
            'password' => 'min:8|confirmed',
            'role_id' =>'required'
        ]);
    }
    protected $messages = [
        'name.required' => 'Thông tin này không được bỏ trống.',
        'password.required' => 'Mật khẩu không được bỏ trống và ít nhất phải có 8 ký tự.',
        'role_id.required'=> 'Mật khẩu không được để trống.'
    ];
    public function mount($id){
    $user = User::find($id);
    $role = role_user::where('user_id',$id)->first();
    $this->name= $user->name;
    $this->email= $user->email;
    $this->role_id= $role->role_id;
    $this->admin_id = $id;
    }

    public function storeAdmin(){
        $this->validate([
            'name' => 'required',
            'password' => 'confirmed',
            'role_id' =>'required'
        ]);
        $user = User::find($this->admin_id);
                $user->name = $this->name;
                if($this->password){
                    $user->password = Hash::make($this->password);
                }
                $user->utype = $this->utype;
                $user->save();
                $user->roles()->sync($this->role_id);
                session()->flash('message','Update admin thành công!');
        }
    public function render()
    {
        $roles = Role::all();
        return view('livewire.admin.adminedit-component',['roles'=>$roles])->layout('layouts.base');
    }
}
