<?php

namespace Alexandra\Base;

class Ajax
{
    public $actions = [];

    public function register()
    {
        foreach ($this->actions as $action => $handler) {
            add_action('wp_ajax_'.$action, $handler);
        }
    }


    public function addAction($actions)
    {
        if(isAssoc($actions)) {
            $this->actions[] = $actions;
            return $this;
        }

        $this->actions = array_merge($this->actions, $actions);
        return $this;
    }

}
