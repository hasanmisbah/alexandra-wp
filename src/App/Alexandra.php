<?php

namespace Alexandra\App;

use Alexandra\Base\Controller;

class Alexandra extends Controller
{
    public array $modules = [
        \Alexandra\App\Module\Admin::class,
    ];

    private Alexandra|null $instance = null;

    final public function boot(): void
    {
        if(!$this->instance) {

            $this->instance = new Alexandra();
        }

        $this->instance->register();
    }

    public function register(): void
    {
        foreach ($this->modules as $module) {

            $instance = $this->instantiate($module);

            if(method_exists($instance, 'register')) {
                $instance->register();
            }

        }
    }

    public function unregister(): void
    {
        foreach ($this->modules as $module) {

            $instance = $this->instantiate($module);

            if(method_exists($instance, 'unregister')) {
                $instance->unregister();
            }

        }
    }

    private function instantiate($class): mixed
    {
        return new $class;
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