<?php

namespace Alexandra\Base;

class BaseController
{
    public $request = null;

    public $model = null;

    public $response = null;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->register();
    }

    public function register()
    {

    }
}
