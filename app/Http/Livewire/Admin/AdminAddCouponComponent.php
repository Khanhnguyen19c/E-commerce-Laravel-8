<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class AdminAddCouponComponent extends Component
{
    use AuthorizesRequests;
    public $code;
    public $type;
    public $value;
    public $cart_value;
    public $expiry_date;

    public function updated($fields){
        $this->validateOnly($fields,[
            'code' => 'required|unique:coupons',
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
    public function storeCoupon(){
        $this->validate([
            'code' => 'required|unique:coupons',
            'type' => 'required',
            'value' => 'required|numeric',
            'cart_value' => 'required|numeric',
            'expiry_date' => 'required'
        ]);
        $this->authorize('coupon-add');
        $coupon = new Coupon();
        $coupon->code = $this->code;
        $coupon->type = $this->type;
        $coupon->value = $this->value;
        $coupon->expiry_date = $this->expiry_date;
        $coupon->cart_value = $this->cart_value;
        $coupon->save();
        session()->flash('message','Bạn đã thêm mã giảm giá thành công!');
        $this->reset();
    }
    public function render()
    {
        return view('livewire.admin.admin-add-coupon-component');
    }
}
