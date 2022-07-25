<?php
namespace Alexandra\Base;

class Controller
{
    use \Alexandra\App\Trait\Enqueueable;

    public mixed $DB;

    public function __construct() {
        global $wpdb;
        $this->DB = $wpdb;
    }

}