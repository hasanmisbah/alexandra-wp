<?php

namespace Alexandra\App\Abstracts;

use Alexandra\Base\Ajax;
use Alexandra\Api\SettingsApi;
use Alexandra\Provider\ViewProvider;
use Alexandra\Provider\AssetProvider;

abstract class ModuleManager
{
    // :TODO - Make this to mandatory use in all modules and remove controller from Module
    /*
     * @var SettingsApi
     */
    public $settings;
    /*
     * @var AssetProvider
     */
    public $assets;
    /*
     * @var ViewProvider
     */
    public $view;
    /*
     * @var Ajax
     */
    public $ajax;
    /*
     * @var array
     */
    public $pages = [];
    /*
     * @var array
     */
    public $subPages = [];
    /*
     * @var array
     */
    public $styles = [];
    /*
     * @var array
     */
    public $scripts = [];
    /*
     * @var array
     */
    public $fieldSettings = [];
    /*
     * @var array
     */
    public $fieldSection = [];
    /*
     * @var array
     */
    public $fields = [];
    /*
     * @var string
     */
    public $menuSlug;
    /*
     * @var array
     */
    public $settingLinks = [];
    /*
     * @var array
     */
    public $ajaxAction = [];

    final public function __construct()
    {
        $this->settings = new SettingsApi();
        $this->assets = new AssetProvider();
        $this->view = new ViewProvider();
        $this->ajax = new Ajax();
        $this->menuSlug = 'alexandra';
    }

    abstract public function activate(): void;

    abstract public function deactivate(): void;

    abstract public function unload(): void;

    final public function registerAssets(): void
    {
        if (empty($this->styles) && empty($this->scripts)) {
            return;
        }

        if (!empty($this->styles)) {
            $this->assets->addCss($this->styles);
        }

        if (!empty($this->scripts)) {
            $this->assets->addScript($this->scripts);
        }

        $this->assets->load();
    }

    final public function registerAjaxAction()
    {
        if (empty($this->ajaxAction)) {
            return;
        }

        $this->ajax->addAction($this->ajaxAction);

        $this->ajax->register();
    }
}
