<?php

namespace Alexandra\App\Traits;

trait Enqueueable
{
    protected $stylesheets = [];
    protected $scripts = [];
    // :Todo will implement weather script is enqueue to frontend or the admin area
    protected $enqueueToFrontEnd = false;

    public function load()
    {
        add_action('admin_enqueue_scripts', [$this, 'registerAssets']);
    }

    public function addCss($srcs)
    {
        if (!isAssoc($srcs)) {
            $this->stylesheets = array_merge($this->stylesheets, $srcs);
            return $this;
        }

        $this->stylesheets[] = $srcs;
        return $this;
    }

    public function addScript($srcs)
    {
        if (!isAssoc($srcs)) {
            $this->scripts = array_merge($this->scripts, $srcs);
            return $this;
        }

        $this->scripts[] = $srcs;
        return $this;
    }

    public function registerAssets($hook)
    {
        $this->registerScripts($hook);
        $this->registerStyleSheets($hook);
    }

    public function registerStyleSheets($hook)
    {
        if (empty($this->stylesheets)) {
            return;
        }

        foreach ($this->stylesheets as $styleSheet) {

            wp_register_style($styleSheet['handle'], $styleSheet['src'], $styleSheet['deps'] ?? [],
                $styleSheet['ver'] ?? false, $styleSheet['media'] ?? 'all');

            if(isset($styleSheet['page']) && $hook !== 'toplevel_page_' . $styleSheet['page']) {
                return;
            }

            wp_enqueue_style($styleSheet['handle']);
        }
    }

    public function registerScripts($hook)
    {
        if (empty($this->scripts)) {
            return;
        }

        foreach ($this->scripts as $script) {
            wp_register_script($script['handle'], $script['src'], $script['deps'] ?? [], $script['ver'] ?? false,
                $script['in_footer'] ?? false);

            if(isset($script['page']) && $hook !== 'toplevel_page_' . $script['page']) {
                return;
            }

            wp_enqueue_script($script['handle']);
        }
    }
}
