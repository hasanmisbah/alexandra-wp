<?php
namespace Alexandra\Base;

class Controller
{
    use \Alexandra\App\Trait\Enqueueable;

    public $DB;

    public function __construct() {
        global $wpdb;
        $this->DB = $wpdb;
    }

    public function addAction($actionName, $callback, $priority = 10, $accepted_args = 1)
    {
        return add_action($actionName, $callback, $priority, $accepted_args);
    }

    public function addMenuPage()
    {
        
    }

}