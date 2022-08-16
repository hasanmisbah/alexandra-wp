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

        $this->shortcodes = [
            [
                'tag'      => 'alex_contact',
                'callback' => [$this, 'shortCode'],
            ]
        ];
        add_action('wp_enqueue_scripts', [$this, 'registerStylesheet']);
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


        $validatedData = $this->model->sanitizeAll($data);
        $contact = $this->model->create($validatedData);

        wp_send_json($contact);
    }

    public function update()
    {
        // :Todo refactor this add validation and move conditional logic to model
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

        $validatedData = $this->model->sanitizeAll($data);

        foreach ($validatedData as $key => $value) {

            if(!$value) {
                unset($validatedData[$key]);
            }
        }

        $result = $this->model->update($id, $validatedData);

        wp_send_json($result);
    }

    public function destroy()
    {
        $id = $this->request->get('id');
        $result = $this->model->delete($id);
        wp_send_json($result);
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
