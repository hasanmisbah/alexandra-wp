<?php

namespace Alexandra\Provider;

use Alexandra\App\Traits\Enqueueable;

class AssetProvider
{
    use Enqueueable;

    public function getStyleSheet($src)
    {
        return $this->getAsset($src, 'css/');
    }

    public function getScript($src)
    {
        return $this->getAsset($src, 'js/');
    }

    public function getAsset($src , $subPath = '')
    {
        return ALEXANDRA_URL . "assets/{$subPath}" . $src;
    }
}
