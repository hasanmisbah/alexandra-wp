<?php

namespace Alexandra\Base;

use Alexandra\Api\SettingsApi;
use Alexandra\Provider\AssetProvider;
use Alexandra\Provider\ViewProvider;

class Container
{
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

    protected $ajax = null;

    protected $model = null;

    public $request = null;

    protected $ajaxAction = [];

    public function __construct()
    {

        $this->settings = new SettingsApi();
        $this->assets = new AssetProvider();
        $this->view = new ViewProvider();

        $this->ajax = new Ajax();

        $this->request = new Request();
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
        add_filter('plugin_action_links_' . ALEXANDRA, [$this, 'registerSettingLinks']);
    }

    public function registerAjaxAction()
    {
        $this->ajax->addAction($this->ajaxAction)->register();
    }

    public function isActive(string $module)
    {
        $options = get_option(MODULE_SETTINGS_SLUG);
        return $options[$module] ?? false;
    }

}
