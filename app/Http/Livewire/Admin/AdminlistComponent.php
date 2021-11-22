<?php

namespace App\Http\Livewire\Admin;

use App\Models\Role;
use App\Models\role_user;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
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
        // $users = User::where('utype','ADM')->role_user()->toSql();

        $users = User::whereHas('role_user', function($q)
        {
            $q->where('utype','ADM')->Orwhere('utype','SADM');

        })->paginate(12);
        // dd($users);
        return view('livewire.admin.adminlist-component',['users'=>$users])->layout('layouts.base');

    }
}
