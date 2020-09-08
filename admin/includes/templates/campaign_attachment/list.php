<?php
require_once __DIR__ . '/../template.php';
require_once __DIR__ . '/../generic/link.php';

class ListCampaignAttachmentTemplate extends Template
{
    public function html($items)
    {
        ob_start(); ?>


        <div class="section">

            <?php foreach ($items as $v) : ?>

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
                        <h1><a class="" href="?page=campaign_attachment&action=view&id=<?= $v['id'] ?>">#<?= $v['id'] ?></a> <a class="" href="?page=campaign&action=view&id=<?= $v['campaign_id'] ?>"><?= $v['campaign_title'] ?></a> &gt;&gt; <a class="" href="?page=attachment&action=view&id=<?= $v['attachment_id'] ?>"><?= $v['attachment_title'] ?></a></h1>
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
