<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class AdminSettingComponent extends Component
{
    use AuthorizesRequests;
    public $email;
    public $phone;
    public $phone2;
    public $address;
    public $map;
    public $twiter;
    public $facebook;
    public $instagram;
    public $pinterest;
    public $youtube;

    public $about;
    public $slogan;
    public $criteria1;
    public $criteria2;
    public $criteria3;

    public function mount(){
        $setting  =Setting::find(1);
        if($setting){
             $this->email = $setting->email;
             $this->phone = $setting->phone;
             $this->phone2 = $setting->phone2;
             $this->address = $setting->address;
             $this->map = $setting->map;
             $this->twiter = $setting->twiter;
             $this->facebook = $setting->facebook;
             $this->instagram = $setting->instagram;
             $this->pinterest = $setting->pinterest;
             $this->youtube = $setting->youtube;
             $this->about = $setting->about_website;
             $this->slogan = $setting->slogan;
             $this->criteria1 = $setting->criteria1;
             $this->criteria2 = $setting->criteria2;
             $this->criteria3 = $setting->criteria3;
        }
    }
    public function updated($fields){
        $this->validateOnly($fields,[
            'email'=> 'required|email',
            'phone'=> 'required',
            'phone2'=> 'required',
            'address'=> 'required',
            'map'=> 'required',
            'twiter'=> 'required',
            'facebook'=> 'required',
            'instagram'=> 'required',
            'pinterest'=> 'required',
            'youtube'=> 'required',
            'about'=> 'required',
            'slogan'=> 'required',
            'criteria1'=> 'required',
            'criteria2'=> 'required',
            'criteria3'=> 'required',
        ]);
    }
    protected $messages = [
        'email.required' => 'Thông tin này không được bỏ trống.',
        'email.email' => 'Bạn phải nhập Định dạng Email vào ô này.',
        'phone.required' => 'Thông tin này không được bỏ trống.',
        'phone2.required' => 'Thông tin này không được bỏ trống.',
        'address.required' => 'Thông tin này không được bỏ trống.',
        'map.required' => 'Thông tin này không được bỏ trống.',
        'twiter.required' => 'Thông tin này không được bỏ trống.',
        'facebook.required' => 'Thông tin này không được bỏ trống.',
        'instagram.required' => 'Thông tin này không được bỏ trống.',
        'pinterest.required' => 'Thông tin này không được bỏ trống.',
        'youtube.required' => 'Thông tin này không được bỏ trống.',
        'about.required'=> 'Thông tin này không được bỏ trống.',
        'slogan.required'=> 'Thông tin này không được bỏ trống.',
        'criteria1.required'=> 'Thông tin này không được bỏ trống.',
        'criteria2.required'=> 'Thông tin này không được bỏ trống.',
        'criteria3.required'=> 'Thông tin này không được bỏ trống.',

    ];
    public function saveSettings(){
        $this->validate([
            'email'=> 'required|email',
            'phone'=> 'required',
            'phone2'=> 'required',
            'address'=> 'required',
            'map'=> 'required',
            'twiter'=> 'required',
            'facebook'=> 'required',
            'instagram'=> 'required',
            'pinterest'=> 'required',
            'youtube'=> 'required',
            'about'=> 'required',
            'slogan'=> 'required',
            'criteria1'=> 'required',
            'criteria2'=> 'required',
            'criteria3'=> 'required',
        ]);
        $this->authorize('footer-edit');
        $setting = Setting::find(1);
        if(!$setting){
            $setting = new Setting();
        }
        $setting->email = $this->email;
            $setting->phone = $this->phone;
            $setting->phone2 = $this->phone2;
            $setting->address = $this->address;
            $setting->map = $this->map;
            $setting->twiter = $this->twiter;
            $setting->facebook = $this->facebook;
            $setting->instagram = $this->instagram;
            $setting->pinterest = $this->pinterest;
            $setting->youtube = $this->youtube;
            $setting->about_website = $this->about;
            $setting->slogan = $this->slogan;
            $setting->criteria1 = $this->criteria1;
            $setting->criteria2 = $this->criteria2;
            $setting->criteria3 = $this->criteria3;
            $setting->save();
            session()->flash('message','Bạn đã cập nhật thông tin thành công!');
    }
    public function render()
    {
        return view('livewire.admin.admin-setting-component')->layout('layouts.base');
    }
}
