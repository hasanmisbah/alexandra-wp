<?php

namespace Alexandra\App\Abstracts;

use Alexandra\Base\Container;

abstract class ModuleManager extends Container
{
    abstract public function register();

    abstract public function deactivate();

    abstract public function uninstall();
}
