<?php
require_once __DIR__ . '/../template.php';
require_once __DIR__ . '/navbar.php';

class DefaultLayoutTemplate extends Template
{
    private function navbar()
    {
        return new NavbarTemplate();
    }

    public function html($title = 'Home', $body = 'Hello, world!', $headers = '')
    {
        $navbar = $this->navbar()->html();

        ob_start(); ?>


        <!doctype html>
        <html lang="en">

        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <!-- Bootstrap CSS -->
            <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->

            <link rel="stylesheet" href="resources/css/colors.css">

            <?= $headers ?>

            <style>
                body {
                    /*background-color: #000;*/
                    color: #a4a4a4;
                    /*background-image: url('https://cdn.wallpapersafari.com/29/6/0V26D1.png');*/
                    /*background-image: url('https://cdn2.hubspot.net/hubfs/398536/Images/blog/bigstock--171177794.jpg');*/
                    background-image: url('resources/img/eagle.png');
                    background-size: cover;
                }

                .container {
                    background-color: rgba(0, 0, 0, 0.666);
                    border-radius: 0.333rem;
                }

                input[type="text"],
                select,
                textarea {
                    background-color: #222 !important;
                    border: none !important;
                }

                select {
                    color: #808080 !important;
                }
            </style>

            <title><?= $title ?></title>
        </head>

        <body>
            <?= $navbar ?>

            <div class="container">
                <?= $body ?>
            </div>

            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->

            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </body>

        </html>


<?php
        return ob_get_clean();
    }
}
