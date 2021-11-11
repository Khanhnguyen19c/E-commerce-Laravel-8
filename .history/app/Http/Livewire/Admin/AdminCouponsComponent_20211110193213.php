<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;

class AdminCouponsComponent extends Component
{
    public $showEditModal = False;


     //open modal add
     public function addPayment(){
        $this->showEditModal = false ;
        $this->dispatchBrowserEvent('show-form'); //event show-form
    }
    //open moadal edit
    public function editPayment($id){
        $payment = Payment::find($id);
        $this->name = $payment->name;
        $this->images = explode(",",$payment->images);
        $this->payment_id = $payment->id;
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
