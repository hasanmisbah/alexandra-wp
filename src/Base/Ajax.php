<?php

namespace Alexandra\Base;

class Ajax
{
    public $actions = [];


    public function register()
    {
        if(empty($this->actions)) {
            return;
        }

        foreach ($this->actions as $action) {
            add_action('wp_ajax_' . $action['action'], $action['callback']);
        }
    }


    public function addAction($actions)
    {
        $this->actions = array_merge($this->actions, $actions);
        return $this;
    }

}
