<?php
require_once __DIR__ . '/../template.php';

class CreateEmailTemplate extends Template
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
                            <label for="title">E-Mail</label>
                            <input class="form-control" type="text" id="email" name="email" placeholder="E-Mail" value="<?= !empty($item['email']) ? $item['email'] : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="uid">UID</label>
                            <input class="form-control" type="text" id="uid" name="uid" placeholder="Client UID" value="<?= !empty($item['uid']) ? $item['uid'] : '' ?>">
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
