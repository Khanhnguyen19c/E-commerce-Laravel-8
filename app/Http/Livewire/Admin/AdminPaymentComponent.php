<?php

namespace App\Http\Livewire\Admin;

use App\Models\Payment;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class AdminPaymentComponent extends Component
{
    use AuthorizesRequests;
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

    //update payment
    public function updatePayment(){
        $this->validate([
            'name'=>'required',
            'images'=>'required|max:10000',
        ]);
        $this->authorize('payment-edit');
        if ($this->newImages) {
            $this->validate([
                'newImages' => 'required|max:10000'
            ]);
        }
        $payment = Payment::find($this->payment_id);
        $payment->name = $this->name;
        if ($this->newImages) {
            if ($payment->images) {
                $images = explode(",", $payment->images);
                foreach ($images as $image) {
                    if ($image) {
                        unlink('assets/images/payments' . '/' . $image);
                    }
                }
            }
            $imagesName = '';
            foreach ($this->newImages as $key => $image) {
                $imgName = Carbon::now()->timestamp . $key . '.' . $image->extension();
                $image->storeAs('payments', $imgName);
                $imagesName = $imagesName . ',' . $imgName;
            }
            $payment->images= $imagesName;
        }

            $payment->save();
            session()->flash('message','Cập nhật đối tác thành công!');
    }

    //delete payment
    public function deletePayment($id){
        $this->authorize('payment-delete');
        $payment = Payment::find($id);
            $images = explode(",",$payment->images);
            foreach($images as $pay){
                if($pay){
                    unlink('assets/images/payments'.'/'.$pay);
                }
            }
        $payment->delete();
        session()->flash('message_del','Xoá đối tác thành công');
    }

    //refesh page
    public function refesh(){
        session()->forget('message');
        $this->emitTo('livewire.admin.admin-payment-component','refreshComponent');
        $this->dispatchBrowserEvent('hide-form');
    }
    public function render()
    {
        $payments = Payment::all();
        return view('livewire.admin.admin-payment-component',['payments'=>$payments])->layout('layouts.base');
    }
}
