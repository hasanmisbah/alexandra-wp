<?php

namespace Alexandra;

class Activator
{
    public static function activate(): void
    {
        flush_rewrite_rules();
    }

    public static function deactivate(): void
    {
        flush_rewrite_rules();
    }

}