<?php
require_once __DIR__ . '/../models/campaign_attachment.php';

class CampaignAttachmentController
{
    public $model;

    public function __construct()
    {
        $this->model = new CampaignAttachmentModel();
    }

    private function validateInsert($data = [])
    {
        $data = $data ?: $_REQUEST;

        return (!empty($data['title']));
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
            'subject' => !empty($data['subject']) ? $data['subject'] : '',
            'body' => !empty($data['body']) ? $data['body'] : ''
        ];

        $this->model->db->onDuplicate($insert, 'id');
        return $this->model->insert($insert);
    }
}
