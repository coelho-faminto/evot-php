<?php
require_once __DIR__ . '/../models/cron.php';

class CronView
{
    public function elapsedTime($name = '')
    {
        $model = new CronModel();

        $name = $model->db->escape($name);

        $row = $model->rawQuery("SELECT TIME_TO_SEC(TIMEDIFF(NOW(), updatedAt)) AS seconds FROM {$model->table_name} WHERE name = '{$name}'");

        return $row ? $row[0]['seconds'] : false;
    }
}
