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

     //open modal add
     public function addCoupon(){
        $this->showEditModal = false ;
        $this->dispatchBrowserEvent('show-form'); //event show-form
    }

    //open moadal edit
    public function editCoupon($id){
        $coupon = Coupon::find($coupon_id);
        $this->code = $coupon->code;
        $this->type = $coupon->type;
        $this->value = $coupon->value;
        $this->cart_value = $coupon->cart_value;
        $this->expiry_date = $coupon->expiry_date;
        $this->showEditModal = true ;
        $this->dispatchBrowserEvent('show-form'); //event show-form
    }

    //delete coupon
    public function DeleteCoupon($coupon_id){
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        session()->flash('message_del','Xoá mã giảm giá thành công');
    }
    public function render()
    {
        $coupons = Coupon::all();
        return view('livewire.admin.admin-coupons-component',['coupons'=>$coupons])->layout('layouts.base');
    }
}
