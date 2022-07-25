<?php

namespace Alexandra\App\Module;

use Alexandra\Base\Controller;
use Alexandra\Api\SettingsApi;

class Admin extends Controller
{
    public const MENU_SLUG = 'alexandra';
    
    public SettingsApi $settings;
    public array $pages = [];
    public array $subPages = [];
    
    public function __construct()
    {
        
        parent::__construct();
        
        $this->settings = new SettingsApi();
        
        $this->pages = [
            [
                'page_title' => 'Alexandra',
                'menu_title' => 'Alexandra',
                'capability' => 'manage_options',
                'menu_slug'  => self::MENU_SLUG,
                'callback'   => function () { echo '<h2>Plugin Pages</h2>'; },
                'icon_url'   => 'dashicons-store',
                'position'   => 110,
            ],
        ];
        
        $this->subPages = [
            [
                'parent_slug' => self::MENU_SLUG,
                'page_title' => 'page_title',
                'menu_title' => 'menu_title',
                'capability' => 'manage_options',
                'menu_slug'  => 'menu_slug',
                'callback'   => function (){ echo '<h1>Hello World from subpages</h1>'; },
            ]
        ];
    }
    
    public function register(): void
    {
        $this->settings->addPages($this->pages)->withSubpages('Settings')->addSubpages($this->subPages)->register();
        add_filter('plugin_action_links_' . ALEXANDRA, [ $this, 'settingLinks' ]);
    }
    
    
    public function settingLinks($links)
    {
        $settingLink = '<a href="admin.php?page=' . self::MENU_SLUG . '">Administration</a>';
        $links[] = $settingLink;
        
        return $links;
    }
    
}