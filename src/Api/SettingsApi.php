<?php

namespace Alexandra\Api;

class SettingsApi
{
    public array $adminPages = [];
    public array $adminSubPages = [];

    public function register(): void
    {
        if(empty($this->adminPages)) {
            return;
        }

        add_action('admin_menu', [ $this, 'addAdminMenu' ]);
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

            $pageTitle = $page['page_title'];
            $menuTitle = $page['menu_title'];
            $capability = $page['capability'];
            $menuSlug = $page['menu_slug'];
            $callback = $page['callback'];
            $iconUrl = $page['icon_url'] ?? '';
            $position = $page['positions'] ?? null;

            add_menu_page($pageTitle, $menuTitle, $capability, $menuSlug, $callback, $iconUrl, $position);
        }
        
        $this->addAdminSubMenu();
    }
    
    public function addAdminSubMenu(): void
    {
        if(empty($this->adminSubPages)) {
            return;
        }
        
        foreach ($this->adminSubPages as $page) {
        
            $parentSlug = $page['parent_slug'];
            $pageTitle = $page['page_title'];
            $menuTitle = $page['menu_title'];
            $capability = $page['capability'];
            $menuSlug = $page['menu_slug'];
            $callback = $page['callback'];
            $position = $page['positions'] ?? null;
        
            add_submenu_page($parentSlug, $pageTitle, $menuTitle, $capability, $menuSlug, $callback, $position);
        }
    }
    
    public function withSubpages(string $title = null): static
    {
        if(empty($this->adminPages)) {
            return $this;
        }
        
        $adminPage = $this->adminPages[0];
        
        $subPage = array(
            array(
                'parent_slug' => $adminPage['menu_slug'],
                'page_title' => $adminPage['page_title'],
                'menu_title' => $title ?? $adminPage['menu_title'],
                'capability' => $adminPage['capability'],
                'menu_slug'  => $adminPage['menu_slug'],
                'callback'   => $adminPage['callback'],
            )
        );
        
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

}