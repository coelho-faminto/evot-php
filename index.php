<?php
require_once __DIR__ . '/admin/includes/templates/generic/default_layout.php';
require_once __DIR__ . '/admin/includes/templates/home.php';
require_once __DIR__ . '/admin/includes/pages/campaign.php';

function main()
{
    $layout = new DefaultLayoutTemplate();

    $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 'home';

    switch ($page) {
        case 'campaign':
            # Campaign Page
            $body = new CampaignPage();
            break;

        default:
            # Home Page
            $body = new HomeTemplate();
            break;
    }

    if (!isset($body)) {
        throw new \Exception("Could not resolve '{$page}' route");
    }

    echo $layout->html('Home', $body->html());
}

try {
    main();
} catch (\Exception $e) {
    echo $e->getMessage();
}
