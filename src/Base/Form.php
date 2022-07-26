<?php

namespace Alexandra\Base;

class Form
{
    public string $action = '';
    public string $method = '';
    public array $elements = [];

    public static function open($action, $method): string
    {
        return sprintf('<form action="%s" method="%s"> ', $action, $method);
    }

    public static function label($for = "", $label = '', $class = ""): string
    {
        return sprintf('<label for="%s" class="%s">%s</label>', $for, $label, $class);
    }

    public static function input($name, $class, $type, $id = '', $value = ''): string
    {
        $input = sprintf('<input name="%s" class="%s" type="%s" id="%s" value="%s"><input>', $name, $class, $type, $id,
            $value);
        return $input;
    }

    public function render(): string
    {
        $form = self::open($this->action, $this->method);
        foreach ($this->elements as $element) {
            $form .= $element;
        }
        $form .= '</form>';
        return $form;
    }

    public static function close(): string
    {
        return '</form>';
    }
}
