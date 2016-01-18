<?php
class RequestListener
{
    private $data;
    private $collection;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    public function parseRequest()
    {
        if(empty($_GET) && empty($_POST)) {
            return $this->indexAction();      
        }
        $this->data = $_REQUEST;
        if(empty($_GET)) {
            return $this->addAction($this->data);
        } else {
            return $this->showAction($this->data['id']);
        }
    }

    private function indexAction()
    {
        return $this->generateJson($this->collection, 'index');
    } 

    private function showAction($id)
    {
        return $this->generateJson($this->collection[$id]);
    }

    private function addAction($data)
    {
        array_push($this->collection, $data);
        $_SESSION['tips'] = $this->collection;
        return $this->generateJson($data);
    }

    private function generateJson($data)
    {
        $preparedData = [
            'status' => 200,
            'data' => $data
        ];
        return json_encode($preparedData);
    }
}
?>