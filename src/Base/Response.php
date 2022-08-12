<?php

namespace Alexandra\Base;

class Response
{
    public function sendAjaxResponse($data, $status = 200)
    {
        wp_send_json($data, $status);
    }

    public function sendAjaxError($message, $status = 400)
    {
        $this->sendAjaxResponse(['message' => $message], $status);
    }

    public function sendAjaxSuccess($data)
    {
        $this->sendAjaxResponse($data);
    }
}
