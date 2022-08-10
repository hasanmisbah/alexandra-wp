<?php

namespace Alexandra\App;

use Alexandra\Base\Container;
use Alexandra\App\Traits\ApplicationContract;

class Alexandra extends Container
{
    use ApplicationContract;

    public $modules = [
        \Alexandra\App\Module\Admin::class,
        \Alexandra\App\Module\ContactBook::class,
        \Alexandra\App\Module\AuthorBio::class,
    ];

    private $instance = null;

    final public function boot()
    {
        if (!$this->instance) {
            $this->instance = new Alexandra();
        }

        $this->instance->register();
    }

}
