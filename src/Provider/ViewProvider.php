<?php

namespace Alexandra\Provider;

class ViewProvider
{
    public function render(string $file, mixed $parameter = null)
    {
        return require_once (ALEXANDRA_PATH . 'src/resource/view/' . $file);
    }
}
