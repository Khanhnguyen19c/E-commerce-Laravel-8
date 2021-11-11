<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;

class AdminSettingComponent extends Component
{
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
        ]);
    }
    protected $messages = [
        'name.required' => 'Thông tin này không được bỏ trống.',
        'slug.required' => 'Thông tin này không được bỏ trống.',
        'short_desc.required' => 'Thông tin này không được bỏ trống.',
        'regular_price.required' => 'Thông tin này không được bỏ trống.',
        'regular_price.numeric' => 'Bạn phải nhập định dạng là chữ số.',
        'sale_price.numeric' => 'Bạn phải nhập định dạng là chữ số.',
        'SKU.required'=> 'Thông tin này không được bỏ trống.',
        'stock_status.required'=> 'Thông tin này không được bỏ trống.',
        'featured.required'=> 'Thông tin này không được bỏ trống.',
        'quantity.required'=> 'Thông tin này không được bỏ trống.',
        'quantity.numeric' => 'Bạn phải nhập định dạng là chữ số.',
        'category_id.required'=> 'Thông tin này không được bỏ trống.',
        'brand_id.required'=> 'Thông tin này không được bỏ trống.',
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
        ]);

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
            $setting->save();
            session()->flash('message','Bạn đã cập nhật thông tin thành công!');
    }
    public function render()
    {
        return view('livewire.admin.admin-setting-component')->layout('layouts.base');
    }
}
