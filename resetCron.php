<?php
require_once __DIR__ . '/admin/includes/controllers/cron.php';

function main()
{
    $controller = new CronController();

    $controller->resetDownload('download_bom');

    echo 'É hora do show, porra!';
}

main();
