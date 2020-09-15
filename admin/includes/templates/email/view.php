<?php
require_once __DIR__ . '/../template.php';
require_once __DIR__ . '/../generic/link.php';

class ViewEmailTemplate extends Template
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
                    <h1>#<?= $item['id'] ?> <?= $item['email'] ?></h1>
                </div>
                <div class="col text-right">
                    <a class="btn btn-secondary btn-sm" role="button" href="?page=email&action=edit&id=<?= $item['id'] ?>">Editar</a>
                    <a class="btn btn-danger btn-sm" role="button" href="?page=email&action=delete&id=<?= $item['id'] ?>">Remover</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h4><?= $item['email'] ?></h4>
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
