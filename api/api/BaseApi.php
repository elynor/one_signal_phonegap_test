<?php
class BaseApi
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getAction()
    {
        $action = null;
        if (isset($this->data['action'])) {
            $action = $this->data['action'];
        }
        return $action;
    }

    public function renderResponse($status, $message)
    {
        header('Content-Type: application/json');
        http_response_code($status);
        $json = json_encode([
            'message' => $message
        ]);

        echo($json);
    }
}
?>