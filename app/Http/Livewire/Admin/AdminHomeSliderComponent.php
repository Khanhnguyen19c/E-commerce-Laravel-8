<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;

class AdminHomeSliderComponent extends Component
{
    public function deleteSlider($id){
        $slider = HomeSlider::find($id);
        if($slider->image){
            unlink('assets/images/sliders'.'/'.$slider->image);
      }
        $slider->delete();
        session()->flash('message','Xoá hình ảnh thành công');
    }
    public function render()
    {
        $sliders = HomeSlider::all();
        $banner = HomeSlider::inRandomOrder()->where('status',2)->limit(2)->get();
        return view('livewire.admin.admin-home-slider-component',['sliders'=>$sliders,'banner'=>$banner])->layout('layouts.base');
    }
}
