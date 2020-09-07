<?php
require_once __DIR__ . '/../models/attachment.php';

class AttachmentController
{
    public $model;

    public function __construct()
    {
        $this->model = new AttachmentModel();
    }

    private function validateInsert($data = [])
    {
        $data = $data ?: $_REQUEST;

        return (
            (!empty($data['title'])) &&
            (!empty($data['url'])));
    }

    public function create($data = [])
    {
        $data = $data ?: $_REQUEST;

        if (!$this->validateInsert()) {
            throw new \Exception('Invalid parameters');
            return false;
        }

        $insert = [
            'title' => $data['title'],
            'description' => !empty($data['description']) ? $data['description'] : '',
            'url' => $data['url']
        ];

        $this->model->db->onDuplicate($insert, 'id');
        return $this->model->insert($insert);
    }
}
