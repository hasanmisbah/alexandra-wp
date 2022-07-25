<?php

namespace Alexandra\App\Module;

use Alexandra\Base\Controller;
use Alexandra\Api\SettingsApi;
use Alexandra\Provider\ViewProvider;
use Alexandra\Provider\AssetProvider;

class Admin extends Controller
{
    public const MENU_SLUG = 'alexandra';

    public SettingsApi $settings;
    public array $pages = [];
    public array $subPages = [];

    public ViewProvider $view;
    public AssetProvider $assets;

    public function __construct()
    {

        parent::__construct();

        $this->settings = new SettingsApi();
        $this->view = new ViewProvider();
        $this->assets = new AssetProvider();

        $this->pages = [
            [
                'page_title' => 'Alexandra',
                'menu_title' => 'Alexandra',
                'capability' => 'manage_options',
                'menu_slug'  => self::MENU_SLUG,
                'callback'   => fn() => $this->view->render('admin.php'),
                'icon_url'   => 'dashicons-store',
                'position'   => 110,
            ],
        ];
    }

    public function register(): void
    {
        $this->settings->addPages($this->pages)->withSubpages('Settings')->addSubpages($this->subPages)->register();

        add_filter('plugin_action_links_' . ALEXANDRA, [ $this, 'settingLinks' ]);

        $this->assets->addCss([
            'handle' => 'Alexandra',
            'src'    => $this->assets->getStyleSheet('alexandra.css'),
        ])->addScript([
            'handle' => 'Alexandra',
            'src'    => $this->assets->getScript('alexandra.js'),
        ])
            ->load();

    }


    public function settingLinks($links)
    {
        $settingLink = '<a href="admin.php?page=' . self::MENU_SLUG . '">Administration</a>';
        $links[] = $settingLink;

        return $links;
    }

}
