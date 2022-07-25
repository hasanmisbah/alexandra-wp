<?php

namespace Alexandra\Provider;

class AssetProvider
{
    public array $css = [];
    public array $js = [];

    public function addCss(string|array $src): static
    {
        $this->css[] = $src;
        return $this;
    }

    public function addScript(string|array $src): static
    {
        $this->js[] = $src;
        return $this;
    }

    public function load(): void
    {
        if(!empty($this->css)) {
            add_action('admin_enqueue_scripts', [ $this, 'registerAssets' ]);
        }
    }

    public function registerAssets(): void
    {
        foreach ($this->css as $styleSheet) {
            wp_register_style($styleSheet['handle'], $styleSheet['src'], $styleSheet['deps'] ?? [],
                $styleSheet['ver'] ?? false, $styleSheet['media'] ?? 'all');
            wp_enqueue_style($styleSheet['handle']);
        }

        foreach ($this->js as $script) {
            wp_register_script($script['handle'], $script['src'], $script['deps'] ?? [], $script['ver'] ?? false,
                $script['in_footer'] ?? false);
            wp_enqueue_script($script['handle']);
        }
    }

    public function getStyleSheet($src): string
    {
        return ALEXANDRA_URL . '/src/resource/css/' . $src;
    }

    public function getScript($src): string
    {
        return ALEXANDRA_URL . '/src/resource/js/' . $src;
    }
}
