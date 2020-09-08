<?php
require_once __DIR__ . '/../template.php';
require_once __DIR__ . '/../generic/link.php';

class ViewCampaignAttachmentTemplate extends Template
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
                <div class="col-auto">
                    <h3><a class="" href="?page=campaign_attachment&action=view&id=<?= $item['id'] ?>">#<?= $item['id'] ?></a> <a class="" href="?page=campaign&action=view&id=<?= $item['campaign_id'] ?>"><?= $item['campaign_title'] ?></a> &gt;&gt; <a class="" href="?page=attachment&action=view&id=<?= $item['attachment_id'] ?>"><?= $item['attachment_title'] ?></a></h3>
                </div>
                <div class="col text-right">
                    <a class="btn btn-secondary btn-sm" role="button" href="?page=campaign_attachment&action=edit&id=<?= $item['id'] ?>">Editar</a>
                    <a class="btn btn-danger btn-sm" role="button" href="?page=campaign_attachment&action=delete&id=<?= $item['id'] ?>">Remover</a>
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
