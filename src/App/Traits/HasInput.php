<?php

namespace Alexandra\App\Traits;

use Alexandra\Base\Form;

trait HasInput
{
    public function checkBoxInput($args)
    {
        $optionName = $args['option_name'];
        $fieldValue = get_option($optionName);
        $classes = $args['class'] ?? '';
        $name = $args['name'] ?? $args['label_for'];
        $id = $args['id'] ?? $args['label_for'];

        echo '<div class="toggle"><input type="checkbox" class="' . $classes . '" name="' . $optionName.'['.$name.']' . '" id="' .
            $id . '" value="1" ' . checked(1, $fieldValue[$name] ?? 0, false) . '></div>';
    }
}
