<?php
require_once __DIR__ . '/../template.php';
require_once __DIR__ . '/../generic/link.php';

class ListAttachmentTemplate extends Template
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

                <div class="row">
                    <div class="col">
                        <h1><a class="" href="?page=attachment&action=view&id=<?= $v['id'] ?>">#<?= $v['id'] ?> <?= $v['title'] ?></a></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h4><?= $v['description'] ?></h4>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col">
                        <h2><a class="" target="_blank" href="<?= $v['url'] ?>"><?= $v['url'] ?></a></h2>
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
