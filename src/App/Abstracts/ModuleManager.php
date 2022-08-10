<?php

namespace Alexandra\App\Abstracts;

use Alexandra\Base\Controller;

abstract class ModuleManager extends Controller
{
    abstract public function register();

    abstract public function deactivate();

    abstract public function uninstall();
}
