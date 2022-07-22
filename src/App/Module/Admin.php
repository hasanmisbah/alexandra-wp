<?php

namespace Alexandra\App\Module;

use Alexandra\Base\Controller;

class Admin extends Controller
{

    public function register(): void
    {
        $this->addAction('admin_menu', [$this, 'install']);
    }

    public function install(): void
    {
        add_menu_page('Alexandra', 'Alexandra', 'manage_options', 'alexandra', [$this, 'index'], 'dashicons-store', 110);
    }

    public function index(): void
    {
        echo '<h2>Plugin Pages</h2>';
    }

}