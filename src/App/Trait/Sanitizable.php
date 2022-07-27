<?php

namespace Alexandra\App\Trait;
trait Sanitizable
{
    public function sanitize($value): string
    {
        return sanitize_text_field($value);
    }

    public function sanitizeCheckBox($value): bool
    {
        return isset($value);
    }

    public function sanitizeEmail($value): string
    {
        return sanitize_email($value);
    }

    public function sanitizeUrl($value): string
    {
        return esc_url($value);
    }
}
