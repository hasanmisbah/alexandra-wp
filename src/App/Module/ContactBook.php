<?php

namespace Alexandra\App\Module;

use Alexandra\App\Models\Contact;
use Alexandra\App\Abstracts\ModuleManager;

class ContactBook extends ModuleManager
{

    public function register()
    {

        $this->ajaxAction = [
            [
                'action'   => 'alexandra_get_all_contacts',
                'callback' => [$this, 'index'],
            ],
            [
                'action'   => 'alexandra_create_contact',
                'callback' => [$this, 'create'],
            ],
            [
                'action'   => 'alexandra_delete_contact',
                'callback' => [$this, 'destroy'],
            ],
            [
                'action'   => 'alexandra_update_contact',
                'callback' => [$this, 'update'],
            ],
        ];
    }

    public function index()
    {
        $contacts = $this->model->all();
        wp_send_json($contacts);
    }

    public function create()
    {
        $data = [
            'name' => $this->request->get('name'),
            'email' => $this->request->get('email'),
            'phone' => $this->request->get('phone'),
            'message' => $this->request->get('message'),
        ];

        //$data = $_REQUEST;

        $validatedData = $this->model->sanitizeAll($data);
        $contact = $this->model->create($validatedData);

        wp_send_json($contact);
    }

    public function update()
    {
        $data = [
            'name' => $this->request->get('name'),
            'email' => $this->request->get('email'),
            'phone' => $this->request->get('phone'),
            'message' => $this->request->get('message'),
        ];

        $id = $this->request->get('id');

        if(!$id) {
            wp_send_json_error('No id provided');
        }

        $contact = $this->model->find($id);


        if(!$contact) {
            wp_send_json_error('Contact not found');
        }

        $validatedData = $this->model->sanitizeAll($data);

        foreach ($validatedData as $key => $value) {

            if(!$value) {
                unset($validatedData[$key]);
            }
        }

        $this->model->update($contact->id, $validatedData);
        $result = $this->model->find($contact->id);
        wp_send_json($result);
    }

    public function destroy()
    {
        $id = $this->request->get('id');

        $contact = $this->model->find($id);

        if(!$contact) {
            wp_send_json(['error' => 'Contact not found'], 404);
        }

        $this->model->delete($contact->id);

        wp_send_json($contact);
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
