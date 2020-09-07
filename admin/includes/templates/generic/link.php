<?php
require_once __DIR__ . '/../template.php';
require_once __DIR__ . '/navbar.php';

class LinkTemplate extends Template
{
    public function html($text = '', $href = '#', $classes = [])
    {
        ob_start(); ?>


        <a class="<?= implode(' ', $classes) ?>" href="<?= $href ?>"><?= $text ?></a>


<?php
        return ob_get_clean();
    }
}
