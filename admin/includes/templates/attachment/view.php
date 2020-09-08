<?php
require_once __DIR__ . '/../template.php';
require_once __DIR__ . '/../generic/link.php';

class ViewAttachmentTemplate extends Template
{
    public function html($item)
    {
        $campaigns = !empty($item['campaign_json']) ? $item['campaign_json'] : '';

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
                    <a class="btn btn-secondary btn-sm" role="button" href="?page=attachment&action=edit&id=<?= $item['id'] ?>">Editar</a>
                    <a class="btn btn-danger btn-sm" role="button" href="?page=attachment&action=delete&id=<?= $item['id'] ?>">Remover</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h4><?= $item['description'] ?></h4>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?php $campaigns = json_decode($campaigns, true); ?>
                    <?php $campaigns = $campaigns ? $this->htmlFilterArray($campaigns) : []; ?>

                    <?php foreach ($campaigns as $v) : ?>

                        <a href="?page=campaign&action=view&id=<?= $v['id'] ?>" class="badge badge-primary"><?= $v['title'] ?></a>

                    <?php endforeach; ?>

                </div>
            </div>

            <div class="row mt-2">
                <div class="col">
                    <h2><a href="<?= $item['url'] ?>" target="_blank"><?= $item['url'] ?></a></h2>
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
