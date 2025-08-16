<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class GlobalBanner extends Component
{
    public $show = false;
    public $message = '';
    public $style = 'success';

    protected $listeners = ['banner-message' => 'showBanner'];

    public function showBanner($data)
    {
        $this->message = $data['message'] ?? '';
        $this->style = $data['style'] ?? 'success';
        $this->show = true;
    }

    public function closeBanner()
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.global-banner');
    }
}
