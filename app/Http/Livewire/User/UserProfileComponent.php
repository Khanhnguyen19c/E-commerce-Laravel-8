<?php

namespace App\Http\Livewire\User;

use App\Models\City;
use App\Models\Profile;
use App\Models\Province;
use App\Models\User;
use App\Models\Ward;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class UserProfileComponent extends Component
{
    public function render()
    {
        $userProfile = Profile::where('user_id',Auth::user()->id)->first();
        if(!$userProfile){
            $profile = new Profile();
            $profile->user_id = Auth::user()->id;
            $profile->save();
        }
        $user = User::find(Auth::user()->id);
        $ward = Ward::where('id',$user->profile->ward)->first();
        $province = Province::where('id',$user->profile->province)->first();
        $city = City::where('id',$user->profile->city)->first();
        $profile = Profile::where('user_id',Auth::user()->id)->first();
        return view('livewire.user.user-profile-component',['user'=>$user,'ward'=>$ward,'province'=>$province,'city'=>$city])->layout('layouts.base');
    }
}
