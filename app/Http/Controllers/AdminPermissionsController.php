<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class AdminPermissionsController extends Controller
{
    public function store(Request $request){
       $permissions = new Permission();
       $permissions->name = $request->module_parent;
       $permissions->display_name = $request->module_parent;
       $permission_id = 0;
       $permissions->parent_id  = $permission_id;
       $permissions->save();
       foreach($request->module_childrent as $item){
        $permissions->name = $item;
        $permissions->display_name = $item;
        $permissions->parent_id = $permission_id;
        $permissions->key_code = $request->module_parent. '_' . $item;
        $permissions->save();
       }
       session()->flash('message','Cập nhật thành công rôi!');
       return redirect()->back();
    }
}
