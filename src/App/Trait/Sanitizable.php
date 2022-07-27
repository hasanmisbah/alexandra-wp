<?php

namespace Alexandra\App\Trait;

trait Sanitizable
{
    public function sanitizeCheckBox($value): bool
    {
        return isset($value);
    }
}
