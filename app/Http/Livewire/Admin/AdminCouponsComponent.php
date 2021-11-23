<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;

class AdminCouponsComponent extends Component
{
    use AuthorizesRequests;
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
        $this->authorize('coupon-edit');
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
        $this->authorize('coupon-delete');
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        session()->flash('message_del','Xoá mã giảm giá thành công');
    }
    //send coupon to users
    public function sendcoupon($coupon_id){
        $this->authorize('coupon-send');
        $users = User::where('utype','USR')->get();
        $coupon = Coupon::find($coupon_id);
        $coupon_date = $coupon->expiry_date;
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Mã khuyến mãi chỉ dành riêng cho bạn ngày".' ' .$now;
        $data_mail= [];
        foreach($users as $user){
            $data_mail['email'][] = $user->email;
        }

        $coupon = array(
            'coupon_code' => $coupon->code,
            'coupon_value' => $coupon->value,
            'coupon_type' => $coupon->tyle,
            'coupon_cartvalue' => $coupon->cart_value,
            'coupon_date' => $coupon_date,
        );
        Mail::send('livewire.admin.admin-MailsendCoupon-component',['coupon'=>$coupon], function($messages) use ($title_mail,$data_mail){
            $messages->to($data_mail['email'])->subject($title_mail);//send this mail with subject
            $messages->from($data_mail['email'],$title_mail);//send from this mail
        });
        session()->flash('message_del','Gửi mail thành công!');
    }
    //refesh page
    public function refesh(){
        session()->forget('message');
        $this->emitTo('livewire.admin.admin-coupons-component','refreshComponent');
        $this->dispatchBrowserEvent('hide-form');

    }
    public function render()
    {
        $coupons = Coupon::all();
        return view('livewire.admin.admin-coupons-component',['coupons'=>$coupons])->layout('layouts.base');
    }
}
