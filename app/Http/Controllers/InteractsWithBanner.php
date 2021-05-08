<?php

namespace App\Http\Controllers;

trait InteractsWithBanner
{
    /**
     * Update the banner message.
     */
    protected function banner($message): void
    {
        request()?->session()->flash('flash.bannerStyle', 'success');
        request()?->session()->flash('flash.banner', $message);
    }

    /**
     * Update the banner message with an danger / error message.
     */
    protected function dangerBanner($message): void
    {
        request()?->session()->flash('flash.bannerStyle', 'danger');
        request()?->session()->flash('flash.banner', $message);
    }
}
