<?php
require_once __DIR__ . '/../template.php';
require_once __DIR__ . '/../generic/link.php';

class DeleteAttachmentTemplate extends Template
{
    public function confirm($item)
    {
        $item = $this->htmlFilterArray($item);

        ob_start(); ?>


        <div class="section">
            <div class="row">
                <div class="col text-center">
                    Tem certeza que deseja remover este anexo?
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <a href="?page=attachment&action=delete&id=<?= $item['id'] ?>&confirm" class="btn btn-danger" role="button">Sim, remover campanha!</a>
                    <a href="?page=attachment&action=view&id=<?= $item['id'] ?>" class="btn btn-secondary" role="button">Não, cancelar!</a>
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
        </div>


<?php
        return ob_get_clean();
    }
}
