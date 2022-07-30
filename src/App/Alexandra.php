<?php

namespace Alexandra\App;

use Alexandra\Base\Controller;
use Alexandra\App\Trait\ApplicationContract;

class Alexandra extends Controller
{
    use ApplicationContract;
    public array $modules = [
        \Alexandra\App\Module\Admin::class,
        \Alexandra\App\Module\Test::class,
    ];

    private Alexandra|null $instance = null;

    final public function boot(): void
    {
        if(!$this->instance) {

            $this->instance = new Alexandra();
        }

        $this->instance->register();
    }

}
