<?php
require_once __DIR__ . '/admin/includes/controllers/cron.php';
require_once __DIR__ . '/admin/includes/views/cron.php';

function main()
{
    $view = new CronView();

    $seconds = $view->elapsedTime('download_bom');

    if (intval($seconds) < 90) {
        echo 'Calma, bebê!';
        return;
    }

    $controller = new CronController();

    $controller->incDownload('download_bom');

    echo 'É hora do show, porra!';
}

main();
