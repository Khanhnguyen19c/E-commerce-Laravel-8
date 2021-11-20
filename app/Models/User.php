<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'facebook_id',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function profile(){
        return $this->hasOne(Profile::class,'user_id');
    }
    public function roles(){
        return $this->belongsToMany(Role::class,'role_user','user_id','role_id');
    }
    public function role_user(){
        return $this->hasMany(role_user::class,'user_id');
    }

    //phân quyền
    public function checkPermissionAccess($permissionCheck){
        //b1 check quyền user đang login
        //b2 check giá trị đưa vào của router xem có phù hợp với quyền của user hay ko
        $roles = auth()->user()->roles;
        foreach($roles as $role){
            $permissions = $role->permissions;
            //key code trung` voi dieu kien check thi hien thi
           if($permissions->contains('key_code',$permissionCheck)){
               return true;
           }
        }
        return  false;
    }
}
