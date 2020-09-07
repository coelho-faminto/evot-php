<?php
require_once __DIR__ . '/template.php';

class HomeTemplate extends Template {
    public function html($content = 'Welcome home!')
    {
        ob_start(); ?>


        <?= $content ?>


<?php
        return ob_get_clean();
    }
}