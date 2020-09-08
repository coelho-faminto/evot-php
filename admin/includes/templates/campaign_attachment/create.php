<?php
require_once __DIR__ . '/../template.php';

class CreateCampaignAttachmentTemplate extends Template
{
    public function html($succ, $err, $item)
    {
        $item = $this->htmlFilterArray($item);

        ob_start(); ?>


        <div class="section">
            <?= $this->displayAlertMessages($succ, $err) ?>
            <div class="row">
                <div class="col">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?= !empty($item['id']) ? $item['id'] : '' ?>">
                        <div class="form-group">
                            <label for="campaign_id">ID da campanha</label>
                            <input class="form-control" type="text" id="campaign_id" name="campaign_id" placeholder="ID da campanha" value="<?= !empty($item['campaign_id']) ? $item['campaign_id'] : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="attachment_id">ID do anexo</label>
                            <input class="form-control" type="text" id="attachment_id" name="attachment_id" placeholder="ID do anexo" value="<?= !empty($item['attachment_id']) ? $item['attachment_id'] : '' ?>">
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-primary" type="submit">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


<?php
        return ob_get_clean();
    }
}
