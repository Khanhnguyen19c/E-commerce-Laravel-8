<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;

class AdminCouponsComponent extends Component
{
    public $showEditModal = False;
    public $code;
    public $type;
    public $value;
    public $cart_value;
    public $coupon_id;
    public $expiry_date;

    //validate
    public function updated($fields){
        $this-> validateOnly($fields,[
            'code' => 'required',
            'type' => 'required',
            'value' => 'required|numeric',
            'cart_value' => 'required|numeric',
            'expiry_date' => 'required'
        ]);
    }
    protected $messages = [
        'code.required' => 'Thông tin này không được bỏ trống.',
        'type.required' => 'Thông tin này không được bỏ trống.',
        'value.required' => 'Thông tin này không được bỏ trống.',
        'value.numeric' => 'Bạn phải nhập định dạng là chữ số.',
        'expiry_date.required'=> 'Thông tin này không được bỏ trống.'
    ];

     //open modal add
     public function addCoupon(){
        $this->showEditModal = false ;
        $this->dispatchBrowserEvent('show-form'); //event show-form
    }

    //open moadal edit
    public function editCoupon($coupon_id){
        $coupon = Coupon::find($coupon_id);
        $this->code = $coupon->code;
        $this->type = $coupon->type;
        $this->value = $coupon->value;
        $this->cart_value = $coupon->cart_value;
        $this->expiry_date = $coupon->expiry_date;
        $this->coupon_id = $coupon_id;
        $this->showEditModal = true ;
        $this->dispatchBrowserEvent('show-form'); //event show-form
    }

    //update coupon
    public function updateCoupon(){
        $this->validate([
            'code' => 'required',
            'type' => 'required',
            'value' => 'required|numeric',
            'cart_value' => 'required|numeric',
            'expiry_date' => 'required'
        ]);
        $coupon = Coupon::find($this->coupon_id);
        $coupon->code = $this->code;
        $coupon->type = $this->type;
        $coupon->value = $this->value;
        $coupon->expiry_date = $this->expiry_date;
        $coupon->cart_value = $this->cart_value;
        $coupon->save();
        session()->flash('message','Bạn đã cập nhật mã giảm giá thành công!');
    }
    //delete coupon
    public function DeleteCoupon($coupon_id){
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        session()->flash('message_del','Xoá mã giảm giá thành công');
    }
    //refesh page
    public function refesh(){
        $this->emitTo('admin.admin.admin-coupons-component','refreshComponent');
        $this->dispatchBrowserEvent('hide-form');
    }
    public function render()
    {
        $coupons = Coupon::all();
        return view('livewire.admin.admin-coupons-component',['coupons'=>$coupons])->layout('layouts.base');
    }
}
