<?php

namespace Alexandra\App\Module;

use Alexandra\Base\Controller;
use Alexandra\Api\SettingsApi;
use Alexandra\Provider\ViewProvider;
use Alexandra\Provider\AssetProvider;

class Admin extends Controller
{
    public const MENU_SLUG = 'alexandra';

    public array $pages = [];
    public array $subPages = [];

    public ViewProvider $view;
    public SettingsApi $settings;
    public AssetProvider $assets;

    public function boot()
    {
        $this->settings = new SettingsApi();
        $this->view = new ViewProvider();
        $this->assets = new AssetProvider();

        // :TODO Move to Page handler and automatically register all assets
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
        $this->boot();
        $this->loadPagesAndAssets();
        add_filter('plugin_action_links_' . ALEXANDRA, [ $this, 'settingLinks' ]);

    }

    public function loadPagesAndAssets()
    {
        $this->settings
            ->addPages($this->pages)
            ->withSubpages('Settings')
            ->addSubpages($this->subPages)
            ->register()
        ;

        $this->assets
            ->addCss([
                'handle' => 'Alexandra',
                'src'    => $this->assets->getStyleSheet('alexandra.css'),
            ])
            ->addScript([
                'handle' => 'Alexandra',
                'src'    => $this->assets->getScript('alexandra.js'),
            ])
            ->load()
        ;
    }


    public function settingLinks($links)
    {
        $settingLink = '<a href="admin.php?page=' . self::MENU_SLUG . '">Administration</a>';
        $links[] = $settingLink;

        return $links;
    }

}
