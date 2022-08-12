<?php

namespace Alexandra\Provider;

class ViewProvider
{
    public function render($file, $parameter = null)
    {
        return require_once(ALEXANDRA_PATH . 'src/resource/view/' . $file);
    }
}
