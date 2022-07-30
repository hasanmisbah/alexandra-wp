<?php

namespace Alexandra\App\Trait;

trait ApplicationContract
{
    public function register(): void
    {
        foreach ($this->modules as $module) {

            $instance = $this->instantiate($module);

            if(!method_exists($instance, 'register')) {
                return;
            }

            $instance->register();
            $this->bindModuleData($instance);
        }

        $this->loadApplicationData();
    }

    public function unregister(): void
    {
        foreach ($this->modules as $module) {

            $instance = $this->instantiate($module);

            if(method_exists($instance, 'unregister')) {
                $instance->unregister();
            }

        }
    }

    private function instantiate($class): object
    {
        return new $class;
    }

    public function loadApplicationData(): void
    {
        $this->registerSettings();
        $this->registerAssets();
        $this->registerMetabox();
        $this->applySettingLinks();
    }

    public function bindModuleData($instance): void
    {
        $this->styles = array_merge($this->styles, (array) $instance->styles);
        $this->scripts = array_merge($this->scripts, (array) $instance->scripts);
        $this->pages = array_merge($this->pages, (array) $instance->pages);
        $this->subPages = array_merge($this->subPages, (array) $instance->subPages);

        $this->settingLinks = array_merge($this->settingLinks, (array) $instance->settingLinks);

        $this->fieldSettings = array_merge($this->fieldSettings, (array) $instance->fieldSettings);
        $this->fieldSection = array_merge($this->fieldSection, (array) $instance->fieldSection);
        $this->fields = array_merge($this->fields, (array) $instance->fields);
    }
}
