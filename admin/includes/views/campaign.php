<?php
require_once __DIR__ . '/_view.php';
require_once __DIR__ . '/../models/campaign.php';

class CampaignView extends View
{
    public $model;

    public function __construct()
    {
        $this->model = new CampaignModel();
    }
}
