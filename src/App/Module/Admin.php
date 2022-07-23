<?php

namespace Alexandra\App\Module;

use Alexandra\Base\Controller;

class Admin extends Controller
{
    public const MENU_SLUG = 'alexandra';

    public function register(): void
    {
        $this->addAction('admin_menu', [$this, 'install']);
        add_filter('plugin_action_links_'.ALEXANDRA, [$this, 'settingLinks']);
    }

    public function install(): void
    {
        add_menu_page('Alexandra', 'Alexandra', 'manage_options', self::MENU_SLUG, [$this, 'index'], 'dashicons-store', 110);
    }

    public function index(): void
    {
        echo '<h2>Plugin Pages</h2>';
    }

    public function settingLinks($links)
    {
        $settingLink = '<a href="admin.php?page='.self::MENU_SLUG .'">Administration</a>';
        $links[] = $settingLink;

        return $links;
    }

}