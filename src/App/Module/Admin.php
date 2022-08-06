<?php

namespace Alexandra\App\Module;

use Alexandra\Base\Controller;
use Alexandra\App\Traits\HasInput;
use Alexandra\App\Traits\Sanitizable;

class Admin extends Controller
{
    use Sanitizable, HasInput;

    public $settingSlug;

    public function boot()
    {
        $this->settingSlug = MODULE_SETTINGS_SLUG;

        $this->pages = [
            [
                'page_title' => 'Alexandra',
                'menu_title' => 'Alexandra',
                'capability' => 'manage_options',
                'menu_slug'  => $this->menuSlug,
                'callback'   => function () {
                    return $this->view->render('admin.php');
                },
                'icon_url'   => 'dashicons-store',
                'position'   => 110,
            ],
        ];

        $this->ajaxAction = [
            [
                'action'   => 'alexandra_get_admin_settings',
                'callback' => [$this, 'getAjaxAdminSettings'],
            ],
            [
                'action'   => 'alexandra_update_admin_settings',
                'callback' => [$this, 'updateAjaxAdminSettings'],
            ]
        ];
    }

    public function register()
    {
        // Boot up the module
        $this->boot();

        $this->settingLinks[] = '<a href="admin.php?page=' . $this->menuSlug . '">Administration</a>';

        // Load Module Assets
        $this->loadPagesAndAssets();
        $this->onActivate();
    }

    public function loadPagesAndAssets()
    {
        $this->styles = [
            [
                'handle' => 'Alexandra',
                'src'    => $this->assets->getStyleSheet('alexandra.css'),
                'page' => $this->menuSlug
            ]
        ];

        $this->scripts = [
            [
                'handle'    => 'Alexandra',
                'src'       => $this->assets->getScript('app.js'),
                'in_footer' => true,
                'page' => $this->menuSlug
            ],
        ];

        // Add localized scripts
        add_action('admin_enqueue_scripts', [$this, 'localizeScript']);
    }

    public function onActivate()
    {
        if (get_option($this->settingSlug)) {
            return;
        }


        // Set Default Options for the plugin
        $defaultSettings = [
            'author_bio' => false,
        ];

        update_option($this->settingSlug, $defaultSettings);
    }

    public function unregister()
    {
    }

    public function localizeScript()
    {
        wp_enqueue_script('alexandra_ajax', $this->assets->getScript('ajax-handler.js'), ['jquery'], null, true);
        wp_localize_script('alexandra_ajax', 'alexandra_collection',
            [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce'    => wp_create_nonce('my-nonce')
            ]
        );
    }

    public function getAjaxAdminSettings()
    {
        $settings = get_option($this->settingSlug);
        wp_send_json_success($settings);
    }

    public function updateAjaxAdminSettings()
    {
        $settings = [
            'author_bio' => (bool)$_POST['author_bio'],
        ];

        update_option($this->settingSlug, $settings);

        $this->getAjaxAdminSettings();
    }

}
