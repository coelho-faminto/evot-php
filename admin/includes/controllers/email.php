<?php
require_once __DIR__ . '/../models/email.php';
require_once __DIR__ . '/../views/client.php';
require_once __DIR__ . '/../controllers/client.php';

class EmailController
{
    public $model;

    public function __construct()
    {
        $this->model = new EmailModel();
    }

    private function validateInsert($data = [])
    {
        $data = $data ?: $_REQUEST;

        return (
            (!empty($data['email'])) &&
            (!empty($data['uid'])));
    }

    private function getClientByUID($data = [])
    {
        $data = $data ?: $_REQUEST;
        $clientView = new ClientView();

        $clientView->model->db->where('uid', $data['uid']);

        $client_id = $clientView->model->db->getOne($clientView->model->table_name);

        var_dump($client_id);

        if (!$client_id) {
            $clientController = new ClientController();

            $client_id = $clientController->create(['uid' => $data['uid']]);
        } else {
            $client_id = $client_id['id'];
        }

        return $client_id;
    }

    public function create($data = [])
    {
        $data = $data ?: $_REQUEST;

        if (!$this->validateInsert()) {
            throw new \Exception('Invalid parameters');
            return false;
        }

        $insert = [
            'email' => $data['email'],
            'client_id' => $this->getClientByUID()
        ];

        $this->model->db->onDuplicate($insert, 'id');
        return $this->model->insert($insert);
    }
}
