<?php
require_once __DIR__ . '/../models/client.php';

class ClientController
{
    public $model;

    public function __construct()
    {
        $this->model = new ClientModel();
    }

    private function validateInsert($data = [])
    {
        $data = $data ?: $_REQUEST;

        return (!empty($data['uid']));
    }

    public function create($data = [])
    {
        $data = $data ?: $_REQUEST;

        if (!$this->validateInsert()) {
            throw new \Exception('Invalid parameters');
            return false;
        }

        $insert = [
            'uid' => $data['uid']
        ];

        $this->model->db->onDuplicate($insert, 'id');
        return $this->model->insert($insert);
    }
}
