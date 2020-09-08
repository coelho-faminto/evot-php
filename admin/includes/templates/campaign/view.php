<?php
require_once __DIR__ . '/../template.php';
require_once __DIR__ . '/../generic/link.php';
require_once __DIR__ . '/../../commons/json.php';

class ViewCampaignTemplate extends Template
{
    public function html($item)
    {
        $attachments = !empty($item['attachment_json']) ? $item['attachment_json'] : '';

        $item = $this->htmlFilterArray($item);

        ob_start(); ?>

        <div class="section">
            <div class="row">
                <div class="col">
                    <hr>
                </div>
            </div>

            <div class="row">
                <div class="col-auto">
                    <h1>#<?= $item['id'] ?> <?= $item['title'] ?></h1>
                </div>
                <div class="col text-right">
                    <a class="btn btn-secondary btn-sm" role="button" href="?page=campaign&action=edit&id=<?= $item['id'] ?>">Editar</a>
                    <a class="btn btn-danger btn-sm" role="button" href="?page=campaign&action=delete&id=<?= $item['id'] ?>">Remover</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h4><?= $item['description'] ?></h4>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?php $attachments = json_decode($attachments, true); ?>
                    <?php $attachments = $attachments ? $this->htmlFilterArray($attachments) : []; ?>

                    <?php foreach ($attachments as $v) : ?>

                        <a href="?page=attachment&action=view&id=<?= $v['id'] ?>" class="badge badge-primary"><?= $v['title'] ?></a>

                    <?php endforeach; ?>

                </div>
            </div>

            <div class="row mt-2">
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
