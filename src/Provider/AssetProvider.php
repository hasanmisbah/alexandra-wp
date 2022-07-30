<?php

namespace Alexandra\Provider;

use Alexandra\App\Trait\Enqueueable;

class AssetProvider
{
    use Enqueueable;

    public function getStyleSheet($src): string
    {
        return $this->getAsset($src, 'css/');
    }

    public function getScript($src): string
    {
        return $this->getAsset($src, 'js/');
    }

    public function getAsset($src , $subPath = ''): string
    {
        return ALEXANDRA_URL . "assets/{$subPath}" . $src;
    }
}
