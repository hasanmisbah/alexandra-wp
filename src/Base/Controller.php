<?php
namespace Alexandra\Base;

class Controller
{
    public mixed $DB;

    public function __construct() {
        global $wpdb;
        $this->DB = $wpdb;
    }

}
