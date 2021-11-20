<?php

namespace App\Http\Livewire\Admin;

use App\Models\Permission;
use App\Models\permission_role;
use App\Models\Role;
use Livewire\Component;

class AdminRolesComponent extends Component
{
    public $name;
    public $display_name;
    public $role_id;
    public $showEditModal = False;

    //delete brand
    public function deleteRole($role_id){
        $role = Role::find($role_id);
        $permissions = permission_role::where('role_id',$role_id)->get();
        foreach($permissions as $permission){
            $permission->delete();
        }
        $role->delete();
        session()->flash('message','Xoá vai trò thành công');
    }


    public function render()
    {
        $permissions = Permission::where('parent_id',0)->get();
        $roles = Role::all();
        return view('livewire.admin.admin-roles-component',['roles'=>$roles,'permissions'=>$permissions])->layout('layouts.base');
    }
}
