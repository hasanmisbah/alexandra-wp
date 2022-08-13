<?php

namespace Alexandra\Base;

class Request
{
    public $method = null;

    public $body = null;

    public $params = [];

    public $headers = [];

    public $cookies = [];

    public $files = [];

    public $server = [];

    public $query = [];

    public $post = [];

    public $get = [];

    public $request = [];

    public $url = [];

    public $uri = [];

    public $urlParts = [];

    public $urlPath = [];

    public $urlQuery = [];

    public $urlFragment = [];

    public $urlHost = [];

    public $urlPort = [];

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->body = file_get_contents('php://input');
        $this->params = $_REQUEST;
        $this->headers = getallheaders();
        $this->cookies = $_COOKIE;
        $this->files = $_FILES;
        $this->server = $_SERVER;
        $this->query = $_GET;

        $this->post = $_POST;
        $this->request = $_REQUEST;
        $this->url = parse_url($_SERVER['REQUEST_URI']);
        $this->uri = explode('/', $this->url['path'] ?? '');
        $this->urlParts = explode('/', $this->url['path'] ?? '');
        $this->urlPath = explode('/', $this->url['path'] ?? '');
        $this->urlQuery = explode('/', $this->url['query'] ?? '');
        $this->urlFragment = explode('/', $this->url['fragment'] ?? '');
        $this->urlHost = explode('/', $this->url['host'] ?? '');
        $this->urlPort = explode('/', $this->url['port'] ?? '');
    }

    public function all()
    {
        return array_merge($this->params, $this->query);
    }

    public function get($key, $default = null)
    {
        return $this->params[$key] ?? $this->query[$key] ?? $default;
    }

    public function has($key)
    {
        return isset($this->params[$key]) || isset($this->query[$key]);
    }

    public function file($key)
    {
        return $this->files[$key];
    }

    public function server($key)
    {
        return $this->server[$key];
    }

    public function body()
    {
        return $this->body;
    }

    public function method()
    {
        return $this->method;
    }

    public function params()
    {
        return $this->params;
    }

    public function query()
    {
        return $this->query;
    }

    public function files()
    {
        return $this->files;
    }

    public function headers()
    {
        return $this->headers;
    }

    public function cookies()
    {
        return $this->cookies;
    }
}
