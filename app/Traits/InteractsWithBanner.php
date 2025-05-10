<?php

namespace App\Traits;

trait InteractsWithBanner
{
    public function banner($message, $style = 'success')
    {
        session()->flash('banner', compact('message', 'style'));
    }

}
