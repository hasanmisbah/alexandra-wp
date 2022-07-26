<?php

namespace Alexandra\Base;

class Form
{
    public static function open($action, $method): string
    {
        $form = '';
        return $form;
    }

    public static function label ($for = "", $class = ""): string
    {
        $tag = '';
        return $tag;
    }

    public static function input($name, $class, $type = 'text', $id, $value = ''): string
    {
        $input = '';
        return $input;
    }

    public static function close(): string
    {
        $tag = '';
        return $tag;
    }
}
