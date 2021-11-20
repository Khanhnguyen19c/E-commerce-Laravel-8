<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role_user extends Model
{
    // protected $gauref= [];
    use HasFactory;
    protected $table = 'role_user';
    public function role(){
        return $this->belongsTo(role_user::class,'role_id');
    }
}
