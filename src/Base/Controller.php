<?php

namespace Alexandra\Base;

use Alexandra\Api\SettingsApi;
use Alexandra\Provider\ViewProvider;
use Alexandra\Provider\AssetProvider;

class Controller
{
    // Global $wpdb instance
    public mixed $DB;

    // SettingsApi instance
    public SettingsApi $settings;

    // Register and enqueue assets
    public AssetProvider $assets;

    // Register and render views
    public ViewProvider $view;

    // List of all pages to be registered
    protected array $pages = [];

    // List of all subpages to be registered
    protected array $subPages = [];

    // list of stylesheets to be enqueued
    protected array $styles = [];

    // list of scripts to be enqueued
    protected array $scripts = [];


    protected array $fieldSettings = [];
    protected array $fieldSection = [];
    protected array $fields = [];

    protected string $menuSlug = 'alexandra';

    protected array $settingLinks = [];

    public function __construct()
    {

        global $wpdb;
        $this->DB = $wpdb;

        $this->settings = new SettingsApi();
        $this->assets = new AssetProvider();
        $this->view = new ViewProvider();
    }

    public function registerSettings(): void
    {
        $this->settings->addPage($this->pages)->addSubPage($this->subPages)->register();
    }

    public function registerAssets(): void
    {
        $this->assets->addCss($this->styles)->addScript($this->scripts)->load();
    }

    public function registerMetabox(): void
    {
        $this->settings->addSettings($this->fieldSettings)->addSection($this->fieldSection)->addField($this->fields);
        $this->settings->register();
    }

    public function registerSettingLinks($links): array
    {
        $this->settingLinks = array_merge($links, $this->settingLinks);
        return $this->settingLinks;
    }

    public function applySettingLinks(): void
    {
        add_filter('plugin_action_links_' . ALEXANDRA, [ $this, 'registerSettingLinks' ]);
    }

}
