<?php

namespace Alexandra\Base;

use Alexandra\Api\SettingsApi;
use Alexandra\Provider\ViewProvider;
use Alexandra\Provider\AssetProvider;

class Controller
{
    // Global $wpdb instance
    public $DB;

    // SettingsApi instance
    public $settings;

    // Register and enqueue assets
    public $assets;

    // Register and render views
    public $view;

    // List of all pages to be registered
    protected $pages = [];

    // List of all subpages to be registered
    protected $subPages = [];

    // list of stylesheets to be enqueued
    protected $styles = [];

    // list of scripts to be enqueued
    protected $scripts = [];


    protected $fieldSettings = [];
    protected $fieldSection = [];
    protected $fields = [];

    protected $menuSlug = 'alexandra';

    protected $settingLinks = [];

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
