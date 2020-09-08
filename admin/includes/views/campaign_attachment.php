<?php
require_once __DIR__ . '/_view.php';
require_once __DIR__ . '/../models/campaign_attachment.php';

class CampaignAttachmentView extends View
{
    public $model;

    public function __construct()
    {
        $this->model = new CampaignAttachmentModel();
    }
}
