<?php

namespace App\Http\Livewire\Admin;

use App\Models\Permission;
use App\Models\Role;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use function Psy\debug;

class AdminaddRolesComponent extends Component
{
    public $selectAll;
    public $selectGroup;
    public $name;
    public $display_name;
    public $selected = [];

    // public function updated($key,$value){
    //     $exlode = Str::of($key)->explode('.');
        //value = value selectGroup kiểm tra check check hay chưa
        //key = lệnh selectall
        //exlode = permission id
        //$exlode[0] = lệnh group all
        //$exlode[1] = permission id
    //     if($exlode[0] === 'selectAll' && empty($value)){
    //         $permissions = Permission::pluck('id')->map(fn($id) => (string)$id)->toArray();
    //         $this->selected = array_values(array_unique(array_merge_recursive($this->selected,$permissions)));
    //     }elseif($exlode[0] === 'selectGroup' && is_numeric($value)){
    //         $permissions = Permission::where('parent_id',$value)->pluck('id')->map(fn($id) => (string)$id)->toArray();
    //         $this->selected = array_values(array_unique(array_merge_recursive($this->selected,$permissions)));
    //     }
    //     elseif($exlode[0] === 'selectGroup' && empty($value)){
    //         $permissions = Permission::where('parent_id',$exlode[1])->pluck('id')->map(fn($id) => (string)$id)->toArray();
    //         $this->selected = array_merge(array_diff($this->selected, $permissions));
    //     }

        // if($value){
        //     $this->check_childrent = Permission::pluck('id');
        // }else{
        //     $this->check_childrent = [];
        // }
    // }
    //add role
    public function addRole(Request $request){

            $role = new Role();
            $role->name = $request->name;
            $role->display_name= $request->display_name;
             $role->save();
            //  dd($request->all());
             $role->permissions()->attach($request->rolesChildrent);
            session()->flash('message','Thêm vai trò vai trò thành công!');
            return redirect()->back();
    }
    public function render()
    {
        $permissions = Permission::where('parent_id',0)->get();
        return view('livewire.admin.adminadd-roles-component',['permissions'=>$permissions])->layout('layouts.base');
    }
}
