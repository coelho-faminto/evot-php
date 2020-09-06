<?php
require_once __DIR__ . '/../models/cron.php';

class CronController
{
    public $model;

    public function __construct()
    {
        $this->model = new CronModel();
    }

    public function resetDownload($name = '')
    {
        $data = [
            'name' => $name,
            'value' => 0
        ];

        $this->model->db->onDuplicate(
            [
                'value' => 0
            ],
            'id'
        );

        return $this->model->insert($data);
    }

    public function incDownload($name = '')
    {
        $data = [
            'name' => $name,
            'value' => 1
        ];

        $this->model->db->onDuplicate(
            [
                'value' => $this->model->db->inc()
            ],
            'id'
        );

        return $this->model->insert($data);
    }
}
