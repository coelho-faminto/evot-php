<?php
require_once __DIR__ . '/../template.php';
require_once __DIR__ . '/../generic/link.php';

class DeleteCampaignTemplate extends Template
{
    public function confirm($item)
    {
        $item = $this->htmlFilterArray($item);

        ob_start(); ?>


        <div class="section">
            <div class="row">
                <div class="col text-center">
                    Tem certeza que deseja remover esta campanha?
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <a href="?page=campaign&action=delete&id=<?= $item['id'] ?>&confirm" class="btn btn-danger" role="button">Sim, remover campanha!</a>
                    <a href="?page=campaign&action=view&id=<?= $item['id'] ?>" class="btn btn-secondary" role="button">Não, cancelar!</a>
                </div>
            </div>
        </div>


    <?php
        return ob_get_clean();
    }

    public function deleted($succ, $err)
    {
        ob_start(); ?>


        <div class="section">
            <?= $this->displayAlertMessages($succ, $err) ?>
        </div>


    <?php
        return ob_get_clean();
    }

    public function html($item)
    {
        $item = $this->htmlFilterArray($item);

        ob_start(); ?>


        <div class="section">
            <div class="row">
                <div class="col">
                    #<?= $item['id'] ?> <?= $item['title'] ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?= $item['description'] ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?= $item['subject'] ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?= nl2br($item['body']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?= (new LinkTemplate())->html('Editar', "?page=campaign&action=edit&id={$item['id']}") ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?= (new LinkTemplate())->html('Remover', "?page=campaign&action=delete&id={$item['id']}") ?>
                </div>
            </div>
        </div>


<?php
        return ob_get_clean();
    }
}
