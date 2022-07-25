<?php

namespace Alexandra\App\Module;

use Alexandra\Base\Controller;
use Alexandra\Api\SettingsApi;
use Alexandra\Provider\ViewProvider;

class Admin extends Controller
{
    public const MENU_SLUG = 'alexandra';

    public SettingsApi $settings;
    public array $pages = [];
    public array $subPages = [];

    public ViewProvider $view;

    public function __construct()
    {

        parent::__construct();

        $this->settings = new SettingsApi();
        $this->view = new ViewProvider();

        $this->pages = [
            [
                'page_title' => 'Alexandra',
                'menu_title' => 'Alexandra',
                'capability' => 'manage_options',
                'menu_slug'  => self::MENU_SLUG,
                'callback'   => fn ()=> $this->view->render('admin.php'),
                'icon_url'   => 'dashicons-store',
                'position'   => 110,
            ],
        ];
    }

    public function register(): void
    {
        $this->settings
            ->addPages($this->pages)
            ->withSubpages('Settings')
            ->addSubpages($this->subPages)
            ->register()
        ;

        add_filter('plugin_action_links_' . ALEXANDRA, [ $this, 'settingLinks' ]);
    }


    public function settingLinks($links)
    {
        $settingLink = '<a href="admin.php?page=' . self::MENU_SLUG . '">Administration</a>';
        $links[] = $settingLink;

        return $links;
    }

}
