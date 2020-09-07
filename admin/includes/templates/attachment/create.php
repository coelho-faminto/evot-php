<?php
require_once __DIR__ . '/../template.php';

class CreateAttachmentTemplate extends Template
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
                            <input class="form-control" type="text" id="title" name="title" placeholder="Título do anexo" value="<?= !empty($item['title']) ? $item['title'] : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <textarea id="description" name="description" class="form-control" rows="5" placeholder="Descrição do anexo"><?= !empty($item['description']) ? $item['description'] : '' ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="url">URL</label>
                            <input class="form-control" type="text" id="url" name="url" placeholder="URL do anexo" value="<?= !empty($item['url']) ? $item['url'] : '' ?>">
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
