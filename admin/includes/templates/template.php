<?php
class Template
{
    protected function htmlFilterArray(array $data)
    {
        if ($data) {
            foreach ($data as $k => $v) {
                if (gettype($v) == 'array') {
                    $data[$k] = $this->htmlFilterArray($v);
                } else {
                    $data[$k] = htmlspecialchars($v, ENT_QUOTES);
                }
            }
        }

        return $data;
    }

    protected function cleanJSON($jsonString)
    {
        if (!is_string($jsonString) || !$jsonString) return '';

        // Remove unsupported characters
        // Check http://www.php.net/chr for details
        for ($i = 0; $i <= 31; ++$i)
            $jsonString = str_replace(chr($i), "", $jsonString);

        $jsonString = str_replace(chr(127), "", $jsonString);

        // Remove the BOM (Byte Order Mark)
        // It's the most common that some file begins with 'efbbbf' to mark the beginning of the file. (binary level)
        // Here we detect it and we remove it, basically it's the first 3 characters.
        if (0 === strpos(bin2hex($jsonString), 'efbbbf')) $jsonString = substr($jsonString, 3);

        return $jsonString;
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
