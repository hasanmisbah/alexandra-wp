<?php

namespace Alexandra\App\Trait;

use Alexandra\Base\Form;

trait HasInput
{
    public function checkBoxInput($args): void
    {
        $fieldValue = get_option($args['name']);
        $classes = $args['class'] ?? '';
        $name = $args['name'] ?? $args['label_for'];
        $id = $args['id'] ?? $args['label_for'];

        echo '<div class="toggle"><input type="checkbox" class="' . $classes . '" name="' . $name . '" id="' . $id . '" value="1" ' .
            checked(1,
                $fieldValue, false) . '></div>';
    }
}
