<?php
require_once __DIR__ . '/../template.php';
require_once __DIR__ . '/../generic/link.php';

class ListCampaignTemplate extends Template
{
    public function html($items)
    {
        ob_start(); ?>


        <div class="section">

            <?php foreach ($items as $v) : ?>

                <?php $v['body'] = $this->get_words($v['body'], 66); ?>

                <?php $v = $this->htmlFilterArray($v); ?>

                <div class="row">
                    <div class="col">
                        <hr>
                    </div>
                </div>

                <!--<div class="row">
                    <div class="col text-right">
                        <a class="btn btn-secondary" role="button" href="?page=campaign&action=edit&id=<?= $v['id'] ?>">Editar</a>
                        <a class="btn btn-danger" role="button" href="?page=campaign&action=delete&id=<?= $v['id'] ?>">Remover</a>
                    </div>
                </div>-->
                <div class="row">
                    <div class="col">
                        <h1><a class="" href="?page=campaign&action=view&id=<?= $v['id'] ?>">#<?= $v['id'] ?> <?= $v['title'] ?></a></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h4><?= $v['description'] ?></h4>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col">
                        <h2><?= $v['subject'] ?></h2>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col text-justify">
                        <quote><?= nl2br($v['body']) ?>...</quote>
                    </div>
                </div>

            <?php endforeach; ?>

            <div class="row">
                <div class="col">
                    <hr>
                </div>
            </div>

        </div>


<?php
        return ob_get_clean();
    }
}
