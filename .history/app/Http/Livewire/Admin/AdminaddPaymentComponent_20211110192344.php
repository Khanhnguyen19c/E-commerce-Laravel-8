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
    protected $messages = [
        'name.required' => 'Thông tin này không được bỏ trống.',
        'images.required' => 'Hình ảnh không được bỏ trống và tối đa là 10MB.',
    ];
    //
    public function storePyament(){
        $this->validate([
            'name'=>'required',
            'images'=>'required|max:10000',
        ]);

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

        return view('livewire.admin.adminadd-payment-component');
    }
}
