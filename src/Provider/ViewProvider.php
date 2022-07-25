<?php

namespace Alexandra\Provider;

use Alexandra\Base\Controller;

class ViewProvider extends Controller
{
    public function render(string $file, mixed $parameter = null)
    {
        return require_once (ALEXANDRA_PATH . 'src/resource/view/' . $file);
    }
}
