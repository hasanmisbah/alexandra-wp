<?php

namespace Alexandra\App\Module;

use Alexandra\Base\Controller;
use Alexandra\App\Traits\HasInput;
use Alexandra\App\Traits\Sanitizable;

class Admin extends Controller
{
    use Sanitizable, HasInput;

    public $settingSlug;

    // :TODO Refactor this and make it more generic and cleaner

    public function boot()
    {
        // :TODO Move to Page handler and automatically register all assets

        //add_action('wp_ajax_alex_ajax_action', [$this, 'ajaxHandler']);

        $this->settingSlug = $this->menuSlug . '_settings';

        $this->pages = [
            [
                'page_title' => 'Alexandra',
                'menu_title' => 'Alexandra',
                'capability' => 'manage_options',
                'menu_slug' => $this->menuSlug,
                'callback' => function () {
                    return $this->view->render('admin.php');
                },//fn() => $this->view->render('admin.php'),
                'icon_url' => 'dashicons-store',
                'position' => 110,
            ],
        ];
        $this->subPages = [
            [
                'parent_slug' => $this->menuSlug,
                'page_title' => 'Custom Post Types',
                'menu_title' => 'Custom Post Types',
                'capability' => 'manage_options',
                'menu_slug' => 'cpt',
                'callback' => function () {
                    echo '<h1>Custom Post Types</h1>';
                },
            ],
        ];

        //add_action('wp_ajax_alex_ajax_action', [$this, 'ajaxHandler']);

        $this->ajaxAction = [
            [
                'action' => 'alexandra_ajax_action',
                'callback' => [$this, 'ajaxHandler'],
            ]
        ];
    }

    public function register()
    {
        // Boot up the module
        $this->boot();

        // Add Custom setting, sections, fields
        $this->setSettings();
        $this->setSections();
        $this->setFields();

        $this->settingLinks[] = '<a href="admin.php?page=' . $this->menuSlug . '">Administration</a>';

        // Load Module Assets
        $this->loadPagesAndAssets();
        $this->onActivate();
    }

    public function loadPagesAndAssets()
    {
        $stylesheets = [
            [
                'handle' => 'Alexandra',
                'src' => $this->assets->getStyleSheet('alexandra.css'),
            ]
        ];

        $scripts = [
            [
                'handle' => 'Alexandra',
                'src' => $this->assets->getScript('app.js'),
                'in_footer' => true,
            ],
        ];
        add_action('admin_enqueue_scripts', [$this, 'localizeScript']);

        $this->styles = $stylesheets;
        $this->scripts = $scripts;
    }

    public function setSettings()
    {
        // :TODO Move to Page handler and automatically register all settings
        // Not using anymore, code reduced using a single array for settings

        // Push to settings array
        $this->fieldSettings[] = [
            'option_group' => ALEXANDRA_PREFIX . '_settings_group',
            'option_name' => $this->settingSlug,
            'callback' => [$this, 'sanitizeCheckBox'],
        ];
    }

    public function setSections()
    {
        $args = [
            [
                'id' => ALEXANDRA_PREFIX . '_admin_index',
                'title' => 'Settings',
                'page' => $this->menuSlug,
            ],
        ];

        $this->fieldSection = $args;
    }

    public function setFields()
    {
        // :TODO Move to Page handler and automatically register all fields
        $fieldList = [
            'cpt_settings' => 'Activate CPT Manager',
            'taxonomy_settings' => 'Activate Taxonomy Manager',
            'widget_settings' => 'Activate Widget Manager',
            'gallery_settings' => 'Activate Gallery Manager',
            'testimonial_settings' => 'Activate Testimonial Manager',
            'template_settings' => 'Activate Template Manager',
            'login_settings' => 'Activate Login Manager',
            'membership_settings' => 'Activate Membership Manager',
            'chat_settings' => 'Activate Chat Manager',
        ];

        foreach ($fieldList as $key => $value) {
            // Push to fields array
            $this->fields[] = [
                'id' => $key,
                'title' => $value,
                'callback' => [$this, 'checkBoxInput'],
                'page' => $this->menuSlug,
                'section' => ALEXANDRA_PREFIX . '_admin_index',
                'args' => [
                    'option_name' => $this->settingSlug,
                    'label_for' => $key,
                    'class' => 'regular-text ui-toggle',
                    'name' => $key,
                    'id' => $key,
                ],
            ];
        }
    }


    public function onActivate()
    {
        if (get_option($this->settingSlug)) {
            return;
        }


        // Set Default Options for the plugin
        $defaultSettings = [
            'cpt_settings' => false,
            'taxonomy_settings' => false,
            'widget_settings' => false,
            'gallery_settings' => false,
            'testimonial_settings' => false,
            'template_settings' => false,
            'login_settings' => false,
            'membership_settings' => false,
            'chat_settings' => false,
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
                'nonce' => wp_create_nonce('my-nonce')
            ]
        );
    }

    public function ajaxHandler()
    {
        wp_send_json_success('success');
        //echo 'Hello World';
    }

}
