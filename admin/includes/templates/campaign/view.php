<?php
require_once __DIR__ . '/../template.php';
require_once __DIR__ . '/../generic/link.php';

class ViewCampaignTemplate extends Template
{
    public function html($item)
    {
        $item = $this->htmlFilterArray($item);

        ob_start(); ?>


        <div class="section">
            <div class="row">
                <div class="col">
                    <hr>
                </div>
            </div>

            <div class="row">
                <div class="col text-right">
                    <a class="btn btn-secondary" role="button" href="?page=campaign&action=edit&id=<?= $item['id'] ?>">Editar</a>
                    <a class="btn btn-danger" role="button" href="?page=campaign&action=delete&id=<?= $item['id'] ?>">Remover</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h1>#<?= $item['id'] ?> <?= $item['title'] ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h4><?= $item['description'] ?></h4>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <h2><?= $item['subject'] ?></h2>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col text-justify">
                    <quote><?= nl2br($item['body']) ?></quote>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <hr>
            </div>
        </div>


<?php
        return ob_get_clean();
    }
}
