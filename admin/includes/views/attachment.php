<?php
require_once __DIR__ . '/_view.php';
require_once __DIR__ . '/../models/attachment.php';

class AttachmentView extends View
{
    public $model;

    public function __construct()
    {
        $this->model = new AttachmentModel();
    }
}
