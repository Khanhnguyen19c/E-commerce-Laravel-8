<?php

namespace App\Http\Livewire\Admin;

use App\Models\Payment;
use Livewire\Component;
use Livewire\WithFileUploads;
class AdminPaymentComponent extends Component
{
    public $showEditModal = False;
    use WithFileUploads;
    public $name;
    public $images;
    public $newImages;
    public $payment_id;

    //validate
    public function undated($fields){
        $this->validateOnly($fields,[
            'name'=>'required',
            'images'=>'required|max:10000',
        ]);
        if ($this->newImage) {
            $this->validateOnly($fields, [
                'newImages' => 'required|max:10000'
            ]);
        }
    }
    protected $messages = [
        'name.required' => 'Thông tin này không được bỏ trống.',
        'images.required' => 'Hình ảnh không được bỏ trống và tối đa là 10MB.',
    ];

    //open moadal edit
    public function editPayment($)
    //delete payment
    public function deletePayment($id){
        $payment = Payment::find($id);
            $images = explode(",",$payment->images);
            foreach($images as $pay){
                if($pay){
                    unlink('assets/images/payments'.'/'.$pay);
                }
            }
        $payment->delete();
        session()->flash('message','Xoá đối tác thành công');
    }

    //refesh page
    public function refesh(){
        $this->emitTo('admin.admin.admin-payment-component','refreshComponent');
        $this->dispatchBrowserEvent('hide-form');
    }
    public function render()
    {
        $payments = Payment::all();
        return view('livewire.admin.admin-payment-component',['payments'=>$payments])->layout('layouts.base');
    }
}
