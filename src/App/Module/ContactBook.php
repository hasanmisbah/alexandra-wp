<?php

namespace Alexandra\App\Module;

use Alexandra\App\Models\Contact;
use Alexandra\App\Abstracts\ModuleManager;
use Alexandra\Base\Request;

class ContactBook extends ModuleManager
{

    public function register()
    {

        $this->ajaxAction = [
            [
                'action'   => 'alexandra_get_all_contacts',
                'callback' => [$this, 'getAllContacts'],
            ],
        ];
    }

    public function getAllContacts()
    {
        $contacts = $this->model->all();
        wp_send_json($contacts);
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
            'email'   => 'john@exaple.com',
            'message' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.'
        ]);
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
