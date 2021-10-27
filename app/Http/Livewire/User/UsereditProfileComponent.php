<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Province;
use App\Models\City;
use App\Models\User;
use App\Models\Ward;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class UsereditProfileComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $mobile;
    public $image;
    public $line1;
    public $line2;
    public $city;
    public $province;
    public $ward;
    public $sex;
    public $newImage;

    public $selectedCity = null;
    public $selectedProvince = null;
    public $selectedWard = null;

    public function mount(){
        $user = User::find(Auth::user()->id);
        $this->name =$user->name;
        $this->email =$user->email;
        $this->mobile =$user->profile->mobile;
        $this->image =$user->profile->image;
        $this->line1 =$user->profile->line1;
        $this->line2 =$user->profile->line2;
        $this->city =$user->profile->city;
        $this->province =$user->profile->province;
        $this->ward =$user->profile->ward;
        $this->sex =$user->profile->sex;

        $this->city = City::all();
        $this->province = collect();
        $this->ward = collect();
        }

    public function updateProfile(){
        $user = User::find(Auth::user()->id);
        $user->name = $this->name;
        $user->save();

        $user->profile->mobile = $this->mobile;
        if($this->newImage){
            if($this->image){
                unlink('assets/images/profile/'.$this->image);
            }
            $imageName = Carbon::now()->timestamp . '.' . $this->newImage->extension();
            $this->newImage->storeAs('profile',$imageName);
            $user->profile->image = $imageName;
        }
        $user->profile->line1 = $this->line1;
        $user->profile->line2 = $this->line2;
        $user->profile->city = $this->selectedCity;
        $user->profile->province = $this->selectedProvince;
        $user->profile->ward = $this->selectedWard;
        $user->profile->sex = $this->sex;
        $user->profile->save();
        session()->flash('message','Cập nhật thông tin cá nhân thành công!');
    }
    public function render()
    {
        $user = User::find(Auth::user()->id);
        return view('livewire.user.useredit-profile-component',['user'=>$user])->layout('layouts.base');
    }


    public function updatedSelectedCity($cities)
    {
        $this->province = Province::where('matp', $cities)->get();
        $this->selectedProvince = NULL;
    }

    public function updatedSelectedProvince($provinces)
    {
        if (!is_null($provinces)) {
            $this->ward = Ward::where('maqh', $provinces)->get();
            $this->selectedWard = NULL;
        }
    }
}
