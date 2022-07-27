<?php

namespace Alexandra\App\Module;

use Alexandra\Base\Form;
use Alexandra\Base\Controller;
use Alexandra\Api\SettingsApi;
use Alexandra\Provider\ViewProvider;
use Alexandra\Provider\AssetProvider;

class Admin extends Controller
{
    public const MENU_SLUG = 'alexandra';

    public array $pages = [];
    public array $subPages = [];

    public array $fieldSettings = [];
    public array $fieldSection = [];
    public array $fields = [];

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
        // Boot up the module
        $this->boot();

        // Add Custom setting, sections, fields
        $this->setSettings();
        $this->setSections();
        $this->setFields();

        // Load Module Assets
        $this->loadPagesAndAssets();

        add_filter('plugin_action_links_' . ALEXANDRA, [ $this, 'settingLinks' ]);

    }

    public function loadPagesAndAssets()
    {
        $this->settings
            ->addPages($this->pages)
            ->withSubpages('Settings')
            ->addSubpages($this->subPages)
            ->addSettings($this->fieldSettings)
            ->addSection($this->fieldSection)
            ->addField($this->fields)
            ->register()
        ;

        $this->assets->addCss([
            'handle' => 'Alexandra',
            'src'    => $this->assets->getStyleSheet('alexandra.css'),
        ])->addScript([
            'handle' => 'Alexandra',
            'src'    => $this->assets->getScript('alexandra.js'),
        ])->load();
    }


    public function settingLinks($links)
    {
        $settingLink = '<a href="admin.php?page=' . self::MENU_SLUG . '">Administration</a>';
        $links[] = $settingLink;

        return $links;
    }

    public function setSettings()
    {
        $args = [
            [
                'option_group' => ALEXANDRA_PREFIX . '_settings_group',
                'option_name'  => 'text_example',
                'callback'     => fn($input) => $input,
            ],
            [
                'option_group' => ALEXANDRA_PREFIX . '_options_group',
                'option_name'  => 'first_name',
                'callback'     => fn($input) => $input,
            ],
        ];

        $this->fieldSettings = $args;

    }

    public function setSections()
    {
        $args = [
            [
                'id'       => ALEXANDRA_PREFIX . '_admin_index',
                'title'    => 'Settings',
                'page'     => self::MENU_SLUG,
            ],
        ];

        $this->fieldSection = $args;
    }

    public function setFields()
    {
        $args = [
            [
                'id'       => 'text_example',
                'title'    => 'Text Example',
                'callback' => function () {
                    $fieldValue = esc_attr(get_option('text_example'));
                    $html = Form::input('text_example', 'text_example regular-text', 'text', 'text_example',
                        $fieldValue);
                    echo $html;
                },
                'page'     => self::MENU_SLUG,
                'section'  => ALEXANDRA_PREFIX . '_admin_index',
                'args'     => [
                    'label_for' => 'text_example',
                    'class'     => 'test-class',
                ],
            ],
            [
                'id'       => 'first_name',
                'title'    => 'First Name',
                'callback' => function () {
                    $fieldValue = esc_attr(get_option('first_name'));
                    echo '<input type="text" class="regular-text" name="first_name" value="' . $fieldValue . '" placeholder="Text Example">';
                },
                'page'     => self::MENU_SLUG,
                'section'  => ALEXANDRA_PREFIX . '_admin_index',
                'args'     => [
                    'label_for' => 'first_name',
                    'class'     => 'test-class',
                ],
            ],
        ];

        $this->fields = $args;
    }

}
