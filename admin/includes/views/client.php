<?php
require_once __DIR__ . '/_view.php';
require_once __DIR__ . '/../models/client.php';

class ClientView extends View
{
    public $model;

    public function __construct()
    {
        $this->model = new ClientModel();
    }
}
