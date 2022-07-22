<?php

namespace Alexandra\App\Trait;

trait Enqueueable
{
    public function enqueueStyle($handle, $src = '', $deps = array(), $ver = false, $media = 'all') :void
    {
        wp_enqueue_style($handle, $src, $deps, $ver, $media);
    }

    public function enqueueScript($handle, $src = '', $deps = array(), $ver = false, $inFooter = false): void
    {
        wp_enqueue_script($handle, $src, $deps, $ver, $inFooter);
    }

    public function AdminEnqueue()
    {
        
    }
}