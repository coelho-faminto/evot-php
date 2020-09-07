<?php
require_once __DIR__ . '/../template.php';

class CreateCampaignTemplate extends Template
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
                        <div class="form-group">
                            <label for="title">Título</label>
                            <input class="form-control" type="text" id="title" name="title" placeholder="Título da campanha" value="<?= !empty($item['title']) ? $item['title'] : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <textarea id="description" name="description" class="form-control" rows="5" placeholder="Descrição da campanha"><?= !empty($item['description']) ? $item['description'] : '' ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="subject">Assunto</label>
                            <input class="form-control" type="text" id="subject" name="subject" placeholder="Assunto do e-mail" value="<?= !empty($item['subject']) ? $item['subject'] : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="body">Email</label>
                            <textarea id="body" name="body" class="form-control" rows="10" placeholder="Corpo do e-mail"><?= !empty($item['body']) ? $item['body'] : '' ?></textarea>
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
