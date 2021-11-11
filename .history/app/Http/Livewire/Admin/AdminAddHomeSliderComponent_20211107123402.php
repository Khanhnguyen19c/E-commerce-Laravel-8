<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;
class AdminAddHomeSliderComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $subtitle;
    public $price;
    public $link;
    public $image;
    public $status;
    public $type;

    public function mount(){
        $this->status = 0;
    }

    public function updated($fields){
        $this->validateOnly($fields,[
            'title' => 'required',
            'subtitle' => 'required',
            'price'=>'required|numeric',
            'link' => 'required',
            'image'=>'required|mimes:jpeg,png',
            'status' => 'required',
            'type' =>'required'
        ]);
    }
    protected $messages = [
        'title.required' => 'Thông tin này không được bỏ trống.',
        'subtitle.required' => 'Thông tin này không được bỏ trống.',
        'price.required' => 'Thông tin này không được bỏ trống.',
        'price.numeric' => 'Bạn phải nhập định dạng là chữ số.',
        'expiry_date.required'=> 'Thông tin này không được bỏ trống.'
    ];
    public function addSlider(){
        $this->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'price'=>'required|numeric',
            'link' => 'required',
            'image'=>'required|mimes:jpeg,png',
            'status' => 'required',
            'type' =>'required'
        ]);
        $slider = new HomeSlider();
        $slider->title = $this->title;
        $slider->subtitle = $this->subtitle;
        $slider->price = $this->price;
        $slider->link = $this->link;
        $imageName = Carbon::now()->timestamp. '.' . $this->image->extension();
        $this->image->storeAs('sliders',$imageName);
        $slider->image = $imageName;
        $slider->status = $this->status;
        $slider->type = $this->type;
        $slider->save();
        session()->flash('message','Thêm Hình ảnh thành công!');
    }
    public function render()
    {
        return view('livewire.admin.admin-add-home-slider-component')->layout('layouts.base');
    }
}
