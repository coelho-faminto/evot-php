<?php
require_once __DIR__ . '/_model.php';
require_once __DIR__ . '/../../../vendor/autoload.php';

class CronModel extends Model
{
    public function __construct()
    {
        parent::__construct();

        $this->table_name = 'cron';
    }
}
