<?php

namespace Alexandra\App;

use Alexandra\Base\Controller;
use Alexandra\App\Traits\ApplicationContract;

class Alexandra extends Controller
{
    use ApplicationContract;

    public $modules = [
        \Alexandra\App\Module\Admin::class,
        \Alexandra\App\Module\ContactBook::class,
        \Alexandra\App\Module\AuthorBio::class,
    ];

    protected $modulerData = [

        // :TODO: Structure this data in a way that it can be used to register modules
        'module_slug' => [
            'module' => 'module_class',
            'title'  => 'Module Title',
        ],
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
