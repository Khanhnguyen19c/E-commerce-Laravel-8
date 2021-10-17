<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;
use App\Models\Setting;
class ContactComponent extends Component
{

    public $name;
    public $email;
    public $phone;
    public $comment;


    public function updated($fiels){
        $this->validateOnly($fiels,[
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'comment' => 'required'
        ]);
    }
    public function sendMessage(){
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'comment' => 'required'
        ]);

        $contact = new Contact();
        $contact->name = $this->name;
        $contact->email = $this->email;
        $contact->phone = $this->phone;
        $contact->comment = $this->comment;
        $contact->save();
        session()->flash('message','Cảm ơn, Vì bạn đã gửi phản hồi cho chúng tôi!');

    }
    public function render()
    {
        $setting = Setting::find(1);
        return view('livewire.contact-component',['setting'=>$setting])->layout('layouts.base');
    }
}
