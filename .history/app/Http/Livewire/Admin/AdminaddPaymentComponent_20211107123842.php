<?php

namespace App\Http\Livewire\Admin;

use App\Models\Payment;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
class AdminaddPaymentComponent extends Component
{
     use WithFileUploads;
    public $name;
    public $images;

    public function undated($fields){
        $this->validateOnly($fields,[
            'name'=>'required',
            'images'=>'required|max:10000',
        ]);
    }
    public function storePyament(){
        $this->validate([
            'name'=>'required',
            'images'=>'required|max:10000',
        ]);
        protected $messages = [
            'title.required' => 'Thông tin này không được bỏ trống.',
            'subtitle.required' => 'Thông tin này không được bỏ trống.',
            'price.required' => 'Thông tin này không được bỏ trống.',
            'price.numeric' => 'Bạn phải nhập định dạng là chữ số.',
            'link.required'=> 'Thông tin này không được bỏ trống.',
            'image.required'=> 'Thông tin này không được bỏ trống.',
            'image.mimes'=> 'Bạn phải chọn một định dạnh jpeg or png.',
            'status.required'=> 'Thông tin này không được bỏ trống.',
            'type.required'=> 'Thông tin này không được bỏ trống.',
        ];
        $payment = new Payment();
        $payment->name = $this->name;
        $imagesname= '';
            foreach($this->images as $key=>$image){
                $imgName = Carbon::now()->timestamp. $key. '.' . $image->extension();
                $image->storeAs('payments',$imgName);
                $imagesname = $imagesname . ',' . $imgName;
            }
            $payment->images= $imagesname;
            $payment->save();
            session()->flash('message','Thêm đối tác thành công!');
    }
    public function render()
    {

        return view('livewire.admin.adminadd-payment-component')->layout('layouts.base');
    }
}
