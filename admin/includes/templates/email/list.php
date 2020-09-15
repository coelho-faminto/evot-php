<?php
require_once __DIR__ . '/../template.php';
require_once __DIR__ . '/../generic/link.php';

class ListEmailTemplate extends Template
{
    public function html($items)
    {
        ob_start(); ?>


        <div class="section">

            <div class="row pt-3">

                <?php foreach ($items as $v) : ?>

                    <?php $v = $this->htmlFilterArray($v); ?>

                    <div class="col-sm-4 pb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><a href="?page=email&action=view&id=<?= $v['id'] ?>"><?= $v['email'] ?></a></h5>
                                <div class="text-right">
                                    <a class="card-link" href="?page=email&action=view&id=<?= $v['id'] ?>">Ver mais...</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--
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
                    -->

                <?php endforeach; ?>

            </div>
        </div>


<?php
        return ob_get_clean();
    }
}
