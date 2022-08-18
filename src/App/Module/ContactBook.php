<?php

namespace Alexandra\App\Module;

use Alexandra\App\Models\Contact;
use Alexandra\App\Abstracts\ModuleManager;
use Alexandra\App\Controllers\ContactController;

class ContactBook extends ModuleManager
{
    public $controller;

    public function register()
    {
        $this->controller = new ContactController();

        $this->ajaxAction = [
            [
                'action'   => 'alexandra_get_all_contacts',
                'callback' => [$this->controller, 'index'],
            ],
            [
                'action'   => 'alexandra_create_contact',
                'callback' => [$this->controller, 'create'],
            ],
            [
                'action'   => 'alexandra_update_contact',
                'callback' => [$this->controller, 'update'],
            ],
            [
                'action'   => 'alexandra_delete_contact',
                'callback' => [$this->controller, 'destroy'],
            ],
        ];

        $this->shortcodes = [
            [
                'tag'      => 'alex_contact',
                'callback' => [$this, 'shortCode'],
            ]
        ];

        add_action('wp_enqueue_scripts', [$this, 'registerStylesheet']);
    }


    public function activate()
    {
        $this->model->createTable();
        $this->loadInitialData();
    }

    public function deactivate()
    {
        $this->model->dropTable();
    }

    public function loadInitialData()
    {
        if ($this->model->exist('email','john@exaple.com')) {
            return;
        }

        $this->model->create([
            'name'    => 'John Doe',
            'phone'   => '123-456-7890',
            'email'   => 'john@example.com',
            'message' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.'
        ]);
    }

    public function shortCode($attr, $content)
    {
        if(!$attr['email']) {
            return 'No id provided';
        }

        $contact = $this->model->find('email', $attr['email']);

        if(!$contact) {
            return 'Contact not found';
        }

        return $this->view->render('contactShortcodeView.php', ['data' => $contact], false);
    }

    public function registerStylesheet()
    {
        wp_register_style('alexandra-contact-short-code', $this->assets->getStyleSheet('contact_short_code.css'));
        wp_enqueue_style('alexandra-contact-short-code');
    }

    public function uninstall()
    {
        // TODO: Implement uninstall() method.
    }

    public function registerContainer()
    {
        $this->model = new Contact();
    }
}
