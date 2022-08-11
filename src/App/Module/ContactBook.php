<?php

namespace Alexandra\App\Module;

use Alexandra\App\Models\Contact;
use Alexandra\App\Abstracts\ModuleManager;

class ContactBook extends ModuleManager
{

    public function register()
    {
        $this->model = new Contact();

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
        if ($this->exist('john@exaple.com')) {
            return;
        }

        $this->model->create([
            'name'    => 'John Doe',
            'phone'   => '123-456-7890',
            'email'   => 'john@exaple.com',
            'message' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.'
        ]);
    }

    public function exist($email)
    {
        global $wpdb;

        $tableName = $wpdb->prefix . 'alexandra_contact_book';
        $sql = "SELECT * FROM {$tableName} WHERE email = '$email'";
        $result = $wpdb->get_results($sql);
        return count($result) > 0;
    }

    public function uninstall()
    {
        // TODO: Implement uninstall() method.
    }
}
