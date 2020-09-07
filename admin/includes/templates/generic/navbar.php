<?php
require_once __DIR__ . '/../template.php';
require_once __DIR__ . '/navbar.php';

class NavbarTemplate extends Template
{
    public function html($title = 'Home', $body = 'Hello, world!', $headers = '')
    {
        ob_start(); ?>


        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
            <a class="navbar-brand" href="#">EVOT Spam</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="?page=index">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=campaign&action=list">Features</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Campanhas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="?page=campaign&action=create">Nova</a>
                            <a class="dropdown-item" href="?page=campaign&action=list">Lista</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Anexos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="?page=attachment&action=create">Novo</a>
                            <a class="dropdown-item" href="?page=attachment&action=list">Lista</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>


<?php
        return ob_get_clean();
    }
}
