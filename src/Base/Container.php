<?php

namespace Alexandra\Base;

use Alexandra\Api\SettingsApi;
use Alexandra\Api\ShortCodeApi;
use Alexandra\App\Models\Model;
use Alexandra\Provider\ViewProvider;
use Alexandra\Provider\AssetProvider;

class Container
{
    /*
     * ::$instances is an array that holds all the instances of the classes
     * the idea behind all the instance is to have a single instance of the class
     * and to use it whenever we need it and run from a single container instance
     * is quite useful for us because we can use the same instance of the class
     * [note : perhaps it's impossible to use WordPress functions from the class itself]
     * */
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

    /* @var $model Model*/
    protected $model = null;

    public $request = null;

    protected $ajaxAction = [];

    protected $shortcodes = [];

    protected $shortcode = null;

    public $controller;

    public function __construct()
    {

        $this->settings = new SettingsApi();
        $this->assets = new AssetProvider();
        $this->view = new ViewProvider();

        $this->ajax = new AjaxHandler();

        $this->request = new Request();

        $this->shortcode = new ShortCodeApi();

        $this->registerContainer();
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

    public function registerShortCodes(): void
    {
        $this->shortcode->addShortCode($this->shortcodes)->register();
    }

    public function isActive(string $module)
    {
        $options = get_option(MODULE_SETTINGS_SLUG);
        return $options[$module] ?? false;
    }

    public function registerContainer()
    {

    }

}
