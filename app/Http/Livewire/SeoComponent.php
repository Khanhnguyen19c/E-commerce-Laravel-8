<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Artesaos\SEOTools\Facades\SEOTools;
class SeoComponent extends Component
{
    public $currentUrl;

    public function mount()
    {
        $this->currentUrl = url()->current();
    }
    public function render()
    {
        SEOTools::setTitle('K-Shopper');
        SEOTools::setDescription('K-Shopper Kinh doanh các loại linh kiện máy tính, thiết bị điện tử');
        SEOTools::opengraph()->setUrl($this->currentUrl);
        SEOTools::setCanonical($this->currentUrl);
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');
        return view('livewire.seo-component');
    }
}
