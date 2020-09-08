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

        return (
            (!empty($data['campaign_id'])) &&
            (!empty($data['attachment_id'])));
    }

    public function create($data = [])
    {
        $data = $data ?: $_REQUEST;

        if (!$this->validateInsert()) {
            throw new \Exception('Invalid parameters');
            return false;
        }

        $insert = [
            'campaign_id' => $data['campaign_id'],
            'attachment_id' => $data['attachment_id']
        ];

        if (!empty($data['id'])) {
            $insert['id'] = $data['id'];
        }

        $this->model->db->onDuplicate($insert, 'id');
        return $this->model->insert($insert);
    }
}
