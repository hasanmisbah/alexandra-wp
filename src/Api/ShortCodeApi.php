<?php

namespace Alexandra\Api;

class ShortCodeApi
{
    public $shortcodes = [];

    /**
     * @param $shortCode array
     * $params  = [
     *      'tag' => string 'shortcode_name',
     *      'callback' => callable $callback,
     * ];
     * @return $this
     */
    public function addShortCode($shortCode)
    {
        if (!isAssoc($shortCode)) {
            $this->shortcodes = array_merge($this->shortcodes, $shortCode);
            return $this;
        }

        $this->shortcodes[] = $shortCode;
        return $this;
    }

    public function register()
    {
        if (!empty($this->shortcodes)) {
            add_action('init', [$this, 'registerShortCodes']);
        }
    }

    public function registerShortCodes()
    {
        foreach ($this->shortcodes as $shortCode) {
            add_shortcode($shortCode['tag'], $shortCode['callback']);
        }
    }
}
