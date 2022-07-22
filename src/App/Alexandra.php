<?php

namespace Alexandra\App;

use Alexandra\Base\Controller;

class Alexandra extends Controller
{
    public array $modules = [
        \Alexandra\App\Module\Admin::class
    ];

    private Alexandra|null $instance = null;

    final public function boot(): void
    {
        // Application Initiator
        $this->register();
    }

    public function register()
    {
        foreach ($this->modules as $module) {
            $instance = $this->instantiate($module);
            if(method_exists($instance, 'register')) {
                $instance->register();
            }
        }
    }

    private function instantiate($class)
    {
        return (new $class);
    }

    public function addModule(array|string $module): static
    {
        if(is_array($module)) {
            foreach ($module as $m) {
                $this->addModule($m);
            }
        }

        $this->modules[] = $module;
        return $this;
    }


}