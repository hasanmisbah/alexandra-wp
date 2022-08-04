<?php

namespace Alexandra\Api;


class SettingsApi
{
    public $adminPages = [];
    public $adminSubPages = [];

    public $settings = [];
    public $sections = [];
    public $fields = [];

    protected $subPageTitle = 'Settings';

    protected $hasSubPages = false;

    public function register()
    {
        if (!empty($this->adminPages)) {
            add_action('admin_menu', [$this, 'addAdminMenu']);
        }

        if (!empty($this->settings)) {
            add_action('admin_init', [$this, 'registerCustomFields']);
        }
    }

    public function addPage($pages)
    {
        if (!isAssoc($pages)) {
            $this->adminPages = array_merge($this->adminPages, $pages);
            return $this;
        }

        $this->adminPages[] = $pages;
        return $this;
    }

    public function addSubpage($pages)
    {
        $this->hasSubPages = true;

        if (empty($this->adminSubPages)) {
            $this->setDefaultSubPage();
        }

        if (!isAssoc($pages)) {
            $this->adminSubPages = array_merge($this->adminSubPages, $pages);
            return $this;
        }

        $this->adminSubPages[] = $pages;
        return $this;
    }

    public function addAdminMenu()
    {
        if (empty($this->adminPages)) {
            return;
        }

        foreach ($this->adminPages as $page) {
            add_menu_page($page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'],
                $page['callback'], $page['icon_url'] ?? '', $page['positions'] ?? null);
        }

        $this->addAdminSubMenu();
    }

    public function addAdminSubMenu()
    {
        if (empty($this->adminSubPages)) {
            return;
        }

        foreach ($this->adminSubPages as $page) {
            add_submenu_page($page['parent_slug'], $page['page_title'], $page['menu_title'], $page['capability'],
                $page['menu_slug'], $page['callback'], $page['positions'] ?? null);
        }
    }

    public function addSettings($settings)
    {
        if (isAssoc($settings)) {
            $this->settings[] = $settings;
            return $this;
        }

        $this->settings = $settings;
        return $this;
    }

    public function addSection($sections)
    {
        if (isAssoc($sections)) {
            $this->sections[] = $sections;
            return $this;
        }

        $this->sections = $sections;
        return $this;
    }

    public function addField($fields)
    {
        if (isAssoc($fields)) {
            $this->fields[] = $fields;
            return $this;
        }

        $this->fields = $fields;
        return $this;
    }


    private function getMenuAttribute($item)
    {
        // :TODO Minimize attribute building and use this method
        $attribute = [

        ];
        //  $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $callback = '', $position = null
        //  $page_title, $menu_title, $capability, $menu_slug, $callback = '', $icon_url = '', $position = null
    }

    /**
     * Loop throw all the settings, section and field and register
     * @return void
     */
    public function registerCustomFields()
    {
        // register settings
        foreach ($this->settings as $setting) {
            register_setting($setting['option_group'], $setting['option_name'], $setting['callback'] ?? []);
        }


        // add setting section
        foreach ($this->sections as $section) {
            add_settings_section($section['id'], $section['title'], $section['callback'] ?? null, $section['page']);
        }

        // add setting field
        foreach ($this->fields as $field) {
            add_settings_field($field['id'], $field['title'], $field['callback'] ?? null, $field['page'],
                $field['section'] ?? 'default', $field['args'] ?? []);
        }
    }

    public function setSubPageTitle(string $title)
    {
        return $this->subPageTitle = $title;
    }


    public function setDefaultSubPage()
    {
        if (!$this->adminPages) {
            return;
        }

        $adminPage = $this->adminPages[0];

        $subPage = [
            [
                'parent_slug' => $adminPage['menu_slug'],
                'page_title' => $adminPage['page_title'],
                'menu_title' => $this->subPageTitle ?? $adminPage['menu_title'],
                'capability' => $adminPage['capability'],
                'menu_slug' => $adminPage['menu_slug'],
                'callback' => $adminPage['callback'],
            ],
        ];

        $this->adminSubPages = $subPage;
    }

}
