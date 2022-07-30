<?php

namespace Alexandra\App\Module;

use Alexandra\Base\Controller;

class Test extends Controller
{
    public function register()
    {
//        $this->pages = [
//            [
//                'page_title' => 'Alexandra 2 ',
//                'menu_title' => 'Alexandra 2 ',
//                'capability' => 'manage_options',
//                'menu_slug'  => 'alexandra2',
//                'callback'   => function(){
//                        echo '<h1>Alexandra 2 </h1>';
//                },
//                'icon_url'   => 'dashicons-store',
//                'position'   => 110,
//            ],
//        ];

        $this->subPages = [
            [
                'parent_slug' => $this->menuSlug,
                'page_title'  => 'Custom Post Types 2 ',
                'menu_title'  => 'Custom Post Types 2 ',
                'capability'  => 'manage_options',
                'menu_slug'   => 'cpts',
                'callback'    => function(){
                    echo '<h1>Custom Post Types 2</h1>';
                },
            ],
        ];

        //$this->registerSettings();
    }
}
