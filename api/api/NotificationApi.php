<?php

class NotificationApi
{
    private $message;
    private $data;
    private $allowedMethods = ['mass', 'user'];
    private $config = [
        'app_id' => '0d7d259e-6c34-4a37-8893-cade140c152b',
        'api_key' => 'M2FlY2M3MWUtNTEzZi00ODU3LWEwZGYtNDMxMTg1NDZhZDdm'
    ];

    public function __construct($dataGlobal)
    {
        $this->data = $dataGlobal;
    }

    public function parseInput($method)
    {
        $status = 200;

        try {
            if (!in_array($method, $this->allowedMethods)) {
                throw new Exception('Method is not allowed');
            }
            if (!isset($this->data['message']) || empty($this->data['message'])) {
                throw new Exception('Message is empty');
            }

            $this->message = $this->data['message'];
            $function = $method . 'Notification';
            $data = $this->$function();

        } catch (Exception $e) {
            $status = 400;
            $data = $e->getMessage();
        }

        return [$status, $data];
    }


    private function massNotification()
    {
        $fields = array(
            'included_segments' => array('All'),
        );

        return $this->sendNotification($fields);
    }


    private function userNotification()
    {
        if (!isset($this->data['device_id']) || empty($this->data['device_id'])) {
            throw new Exception('User device id is empty');
        }
        $fields = array(
            'include_player_ids' => [$this->data['device_id']],
        );

        return $this->sendNotification($fields);
    }


    private function sendNotification($fields)
    {
        $content = array(
            "en" => $this->message
        );
        $fields['contents'] = $content;
        $fields['app_id'] = $this->config['app_id'];
        $jsonFields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
            'Authorization: Basic ' . $this->config['api_key']));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonFields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
