<?php

namespace Alexandra\App\Trait;

trait Enqueueable
{
    protected array $stylesheets = [];
    protected array $scripts = [];
    // :Todo will implement weather script is enqueue to frontend or the admin area
    protected bool $enqueueToFrontEnd = false;

    public function load(): void
    {
        add_action('admin_enqueue_scripts', [ $this, 'registerAssets' ]);
    }

    public function addCss(string|array $srcs): static
    {
        if(!isAssoc($srcs)) {
            $this->stylesheets = array_merge($this->stylesheets, $srcs);
            return $this;
        }

        $this->stylesheets[] = $srcs;
        return $this;
    }

    public function addScript(string|array $srcs): static
    {
        if(!isAssoc($srcs)) {
            $this->scripts = array_merge($this->scripts, $srcs);
            return $this;
        }

        $this->scripts[] = $srcs;
        return $this;
    }

    public function registerAssets(): void
    {
        $this->registerScripts();
        $this->registerStyleSheets();
    }

    public function registerStyleSheets(): void
    {
        if(empty($this->stylesheets)) {
            return;
        }

        foreach ($this->stylesheets as $styleSheet) {
            wp_register_style($styleSheet['handle'], $styleSheet['src'], $styleSheet['deps'] ?? [],
                $styleSheet['ver'] ?? false, $styleSheet['media'] ?? 'all');
            wp_enqueue_style($styleSheet['handle']);
        }
    }

    public function registerScripts(): void
    {
        if(empty($this->scripts)) {
            return;
        }

        foreach ($this->scripts as $script) {
            wp_register_script($script['handle'], $script['src'], $script['deps'] ?? [], $script['ver'] ?? false,
                $script['in_footer'] ?? false);
            wp_enqueue_script($script['handle']);
        }
    }
}
