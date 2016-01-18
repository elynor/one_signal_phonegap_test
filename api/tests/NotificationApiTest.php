<?php

class NotificationApiTest extends PHPUnit_Framework_TestCase
{
    private $emptyData = [];


    public function testEmptyActionMessage()
    {
        $action = null;
        $api = new NotificationApi($this->emptyData);
        list($status, $message) = $api->parseInput($action);
        $this->assertEquals('400', $status);
        $this->assertEquals('Method is not allowed', $message);
    }

    public function testMassEmptyMessage()
    {
        $action = 'mass';
        $api = new NotificationApi($this->emptyData);
        list($status, $message) = $api->parseInput($action);
        $this->assertEquals('400', $status);
        $this->assertEquals('Message is empty', $message);
    }

    public function testMassValidData()
    {
        $action = 'mass';
        $data = ['message' => 'Hello from tests'];
        $api = new NotificationApi($data);
        list($status, $message) = $api->parseInput($action);
        $this->assertEquals('200', $status);
    }

    public function testUserEmptyMessage()
    {
        $action = 'user';
        $api = new NotificationApi($this->emptyData);
        list($status, $message) = $api->parseInput($action);
        $this->assertEquals('400', $status);
        $this->assertEquals('Message is empty', $message);
    }

    public function testUserEmptyUserId()
    {
        $action = 'user';
        $data = ['message' => 'Hello from tests'];
        $api = new NotificationApi($data);
        list($status, $message) = $api->parseInput($action);
        $this->assertEquals('400', $status);
        $this->assertEquals('User device id is empty', $message);
    }

    public function testUserValidData()
    {
        $action = 'user';
        $data = ['message' => 'Hello from tests', 'device_id' => 'bb33d2f0-7f0e-4539-b303-9f0c86d5d6e5'];
        $api = new NotificationApi($data);
        list($status, $message) = $api->parseInput($action);
        $this->assertEquals('200', $status);
    }
}
