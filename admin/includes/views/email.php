<?php
require_once __DIR__ . '/_view.php';
require_once __DIR__ . '/../models/email.php';

class EmailView extends View
{
    public $model;

    public function __construct()
    {
        $this->model = new EmailModel();
    }
}
