<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    public function rolesChildrent(){
        return $this->hasMany(Permission::class,'parent_id');
    }
    public function permission_role(){
        return $this->hasMany(permission_role::class,'permission_id');
    }
}
