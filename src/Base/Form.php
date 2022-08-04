<?php

namespace Alexandra\Base;

class Form
{
    public $action = '';
    public $method = '';
    public $elements = [];

    public static function open($action, $method)
    {
        return sprintf('<form action="%s" method="%s"> ', $action, $method);
    }

    public static function label($for = "", $label = '', $class = "")
    {
        return sprintf('<label for="%s" class="%s">%s</label>', $for, $label, $class);
    }

    public static function input($name, $class, $type = 'text', $id = '', $value = '')
    {
        $input = sprintf('<input name="%s" class="%s" type="%s" id="%s" value="%s"/>', $name, $class, $type, $id,
            $value);
        return $input;
    }

    public function render()
    {
        $form = self::open($this->action, $this->method);
        foreach ($this->elements as $element) {
            $form .= $element;
        }
        $form .= '</form>';
        return $form;
    }

    public static function close()
    {
        return '</form>';
    }
}
