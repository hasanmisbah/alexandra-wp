<?php

namespace Alexandra\Api;


class SettingsApi
{
    public array $adminPages = [];
    public array $adminSubPages = [];

    public array $settings = [];
    public array $sections = [];
    public array $fields = [];

    public function register(): void
    {
        if(!empty($this->adminPages)) {
            add_action('admin_menu', [ $this, 'addAdminMenu' ]);
        }

        if(!empty($this->settings)) {
            $this->registerCustomFields();
        }
    }

    public function addPages(array $pages): static
    {
        if(isAssoc($pages)) {
            $this->adminPages[] = $pages;
            return $this;
        }

        $this->adminPages = $pages;
        return $this;
    }

    public function addAdminMenu(): void
    {
        if(empty($this->adminPages)) {
            return;
        }

        foreach ($this->adminPages as $page) {
            add_menu_page($page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'],
                $page['callback'], $page['icon_url'] ?? '', $page['positions'] ?? null);
        }

        $this->addAdminSubMenu();
    }

    public function addAdminSubMenu(): void
    {
        if(empty($this->adminSubPages)) {
            return;
        }

        foreach ($this->adminSubPages as $page) {
            add_submenu_page($page['parent_slug'], $page['page_title'], $page['menu_title'], $page['capability'],
                $page['menu_slug'], $page['callback'], $page['positions'] ?? null);
        }
    }

    public function withSubpages(string $title = null): static
    {
        if(empty($this->adminPages)) {
            return $this;
        }

        $adminPage = $this->adminPages[0];

        $subPage = [
            [
                'parent_slug' => $adminPage['menu_slug'],
                'page_title'  => $adminPage['page_title'],
                'menu_title'  => $title ?? $adminPage['menu_title'],
                'capability'  => $adminPage['capability'],
                'menu_slug'   => $adminPage['menu_slug'],
                'callback'    => $adminPage['callback'],
            ],
        ];

        $this->adminSubPages = $subPage;
        return $this;
    }

    public function addSubpages(array $pages): static
    {
        if(isAssoc($pages)) {
            $this->adminSubPages[] = $pages;
        }

        $this->adminSubPages = array_merge($this->adminSubPages, $pages);
        return $this;
    }

    public function adSettings(array $settings): static
    {
        $this->settings[] = $settings;
        return $this;
    }

    public function adSection(array $sections): static
    {
        $this->sections[] = $sections;
        return $this;
    }

    public function adField(array $fields): static
    {
        $this->fields[] = $fields;
        return $this;
    }


    private function getMenuAttribute(array $item): void
    {
        // :TODO Minimize attribute building and use this method
        $attribute = [

        ];
        //  $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $callback = '', $position = null
        //  $page_title, $menu_title, $capability, $menu_slug, $callback = '', $icon_url = '', $position = null
    }

    public function registerCustomFields(): void
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
            add_settings_field($field['id'], $field['title'], $field['callback'] ?? null, $field['page'], $field['section'] ?? 'default',
                $field['args'] ?? array());
        }

    }

}
