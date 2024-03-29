<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
class AdminEditHomeSliderComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $subtitle;
    public $price;
    public $link;
    public $image;
    public $status;
    public $slider_id;
    public $newImage;
    public $type;

    public function mount($slider_id){
        $slider = HomeSlider::find($slider_id);
        $this->title = $slider->title;
        $this->subtitle = $slider->subtitle;
        $this->price = $slider->price;
        $this->link = $slider->link;
        $this->image = $slider->image;
        $this->status = $slider->status;
        $this->slider_id = $slider_id;
        $this->type = $slider->type;
    }
    public function updated($fields){
        $this->validateOnly($fields,[
            'title' => 'required',
            'subtitle' => 'required',
            'price'=>'required|numeric',
            'link' => 'required',
            'status' => 'required',
            'type' =>'required'
        ]);
    }
    public function updateSlider(){
        $this->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'price'=>'required|numeric',
            'link' => 'required',
            'status' => 'required',
            'type' =>'required'
        ]);
        $slider = HomeSlider::find($this->slider_id);
        $slider->title = $this->title;
        $slider->subtitle = $this->subtitle;
        $slider->price = $this->price;
        if($this->newImage)
        {
            unlink('assets/images/sliders'.'/'.$slider->image);
            $imageName = Carbon::now()->timestamp. '.' . $this->newImage->extension();
            $this->newImage->storeAs('sliders',$imageName);
            $slider->image = $imageName;
        }
        $slider->status = $this->status;
        $slider->title = $this->title;
        $slider->type = $this->type;
        $slider->save();
        session()->flash('message','Cập nhật Hình ảnh thành công!');
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-home-slider-component')->layout('layouts.base');
    }
}
