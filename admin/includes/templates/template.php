<?php
class Template
{
    protected function htmlFilterArray(array $data)
    {
        if ($data) {
            foreach ($data as $k => $v) {
                $data[$k] = htmlspecialchars($v, ENT_QUOTES);
            }
        }

        return $data;
    }

    protected function get_words($sentence, $count = 10)
    {
        preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $sentence, $matches);
        return trim($matches[0]);
    }

    protected function displayAlertMessages($succ, $err)
    {
        ob_start(); ?>


        <?php foreach ($succ as $m) : ?>

            <div class="row">
                <div class="col">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $m ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

        <?php foreach ($err as $m) : ?>

            <div class="row">
                <div class="col">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= $m ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>


<?php
        return ob_get_clean();
    }
}
