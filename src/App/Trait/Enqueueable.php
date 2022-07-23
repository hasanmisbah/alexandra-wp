<?php

namespace Alexandra\App\Trait;

trait Enqueueable
{
    protected array $stylesheet = [];
    protected array $scripts = [];
    protected bool $enqueueToFrontEnd = false;

    public function enqueueStyle(...$args): void
    {
        $handle = $args['handle'] ?? null;
        $src = $args['src'] ?? null;
        $deps = $args['deps'] ?? [];
        $ver = $args['ver'] ?? false;
        $media = $args['media'] ?? 'all';

        wp_enqueue_style($handle, $src, $deps, $ver, $media);
    }

    public function enqueueScript(...$args): void
    {
        $handle = $args['handle'] ?? null;
        $src = $args['src'] ?? '';
        $deps = $args['deps'] ?? [];
        $ver = $args['ver'] ?? false;
        $inFooter = $args['in_footer'] ?? false;

        wp_enqueue_script($handle, $src, $deps, $ver, $inFooter);
    }

    public function addStyle(...$src): static
    {
        $this->stylesheet[] = $src;
        return $this;
    }

    public function addScript($src): static
    {
        $this->scripts[] = $src;
        return $this;
    }

    public function enqueue(): static
    {

//        if($this->enqueueToFrontEnd) {
//            do_action('wp_enqueue_scripts', [ $this, 'registerScriptAndStyle' ]);
//            return $this;
//        }

        do_action('admin_enqueue_scripts', array($this, 'registerScriptAndStyle'));
        return $this;
    }

    public function toFrontEnd(): static
    {
        $this->enqueueToFrontEnd = true;
        return $this;
    }

    public function registerScriptAndStyle($hook): void
    {
        wp_enqueue_style('my-stylesheet', ALEXANDRA_MODULE_URL . 'CPT/assets/css/stylesheet.css');
//        if(empty($this->stylesheet) && empty($this->scripts)) {
//            return;
//        }
//
//        if(!empty($this->stylesheet)) {
//            foreach ($this->stylesheet as $style) {
//                $this->enqueueStyle($style);
//            }
//        }
//
//        if(!empty($this->scripts)) {
//            foreach ($this->scripts as $script) {
//                $this->enqueueScript($script);
//            }
//        }

        // Reset everything
//        $this->stylesheet = [];
//        $this->scripts = [];
//        $this->enqueueToFrontEnd = false;
    }
}