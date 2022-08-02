<?php

namespace Alexandra\Base;

class Ajax
{
    public $actions = [];

    public function __construct()
    {
        add_action('wp_ajax_alex_ajax_action', [$this, 'ajaxAction']);
//        $this->registerActions();
    }

    public function registerActions()
    {
//        foreach ($this->actions as $action => $handler) {
//            add_action('wp_ajax_'.$action, $handler);
//        }
    }

    public function ajaxAction()
    {

        wp_send_json_success($_REQUEST);
    }

}
