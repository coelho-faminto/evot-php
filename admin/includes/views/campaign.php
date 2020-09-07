<?php
require_once __DIR__ . '/../models/campaign.php';

class CampaignView
{
    public $model;

    public function __construct()
    {
        $this->model = new CampaignModel();
    }

    public function getCampaignById($id = '')
    {
        if (empty($id)) {
            $id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : '';
        }

        $this->model->db->where('id', $id);
        return $this->model->db->getOne($this->model->table_name);
    }
}
