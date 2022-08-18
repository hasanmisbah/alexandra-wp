<?php

namespace Alexandra\App\Controllers;

use Alexandra\App\Models\Contact;

class ContactController extends Controller
{

    public function init()
    {
        $this->model = new Contact();
    }

    public function index()
    {
        $contacts = $this->model->all();
        $this->response->sendAjaxResponse($contacts);
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

        $this->response->sendAjaxResponse($contact);
    }

    public function update()
    {
        $id = $this->request->get('id');

        if(!$id) {
            wp_send_json_error('No id provided');
        }

        $data = [
            'name' => $this->request->get('name'),
            'email' => $this->request->get('email'),
            'phone' => $this->request->get('phone'),
            'message' => $this->request->get('message'),
        ];


        $validatedData = $this->model->sanitizeAll($data);

        foreach ($validatedData as $key => $value) {

            if(!$value) {
                unset($validatedData[$key]);
            }
        }

        $result = $this->model->update($id, $validatedData);

        $this->response->sendAjaxResponse($result);
    }

    public function destroy()
    {
        $id = $this->request->get('id');
        $result = $this->model->delete($id);
        $this->response->sendAjaxResponse($result);
    }
}
