<?php

namespace App\Http\Livewire\Admin;

use App\Models\Role;
use App\Models\role_user;
use App\Models\User;
use Livewire\Component;

class AdminlistComponent extends Component
{
    public function deleteAdmin($id){
        $user = User::find($id);
        $role_user = role_user::where('user_id',$user)->get();
        foreach($role_user as $role){
            $role->delete();
        }
        $user->delete();
        session()->flash('message','Xoá admin thành công');
    }
    public function render()
    {
        $users = User::where('utype','ADM')->paginate(12);
        return view('livewire.admin.adminlist-component',['users'=>$users])->layout('layouts.base');
    }
}
