<?php

namespace Alexandra\Base;

use Alexandra\App\Models\Model;

class BaseController
{
    public $request = null;

    /* @var $model Model */
    public $model = null;

    public $response = null;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->init();
    }

    public function init()
    {

    }
}
