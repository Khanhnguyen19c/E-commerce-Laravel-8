<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Coupon;
class AdminEditCouponComponent extends Component
{
    public $code;
    public $type;
    public $value;
    public $cart_value;
    public $coupon_id;
    public $expiry_date;

    public function mount($coupon_id){
        $coupon = Coupon::find($coupon_id);
        $this->code = $coupon->code;
        $this->type = $coupon->type;
        $this->value = $coupon->value;
        $this->cart_value = $coupon->cart_value;
        $this->expiry_date = $coupon->expiry_date;
    }

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
    public function editCoupon(){
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
    public function render()
    {
        return view('livewire.admin.admin-edit-coupon-component')->layout('layouts.base');
    }
}
