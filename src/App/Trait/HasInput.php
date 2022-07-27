<?php

namespace Alexandra\App\Trait;

use Alexandra\Base\Form;

trait HasInput
{
    public function checkBoxInput($args):void
    {
        $fieldValue = get_option($args['name']);
       echo Form::input($args['name'], $args['class'], 'checkbox', $args['id'], $fieldValue);
    }
}
